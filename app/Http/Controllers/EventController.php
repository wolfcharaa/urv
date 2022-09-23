<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\UrvObject;
use App\Service\Firebird\FirebirdDataBase;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    public function create(Request $request)
    {
        /**
         * Создание новой записи в базе данных
         */
        $requestData = $request->toArray();
        $event = new Event();
        $event->event_time = Carbon::createFromFormat('Y-m-d H:i:s', $requestData['event_time']); //TODO обновлен формат
        $event->name = $requestData['name']; //TODO имя убрать в юзера urvUser
        $event->screen_url = $requestData['screen_url'];
        $event->screen_path = $requestData['screen_path'];
        $event->event_status_id = $requestData['status'];
        $urvObject = UrvObject::query()->find($requestData['urv_object_id']);
        $event->urv_object()->associate($urvObject);
        $event->save();
    }

    public function getAll()
    {
        /**
         * Возврат всех записей в базе данных
         */
        return new JsonResponse(Event::all());
    }

    public function get(int $id)
    {
        /**
         * Поиск даннных по базе при помощи ключа id
         */
        $event = Event::query()->find($id);
        return new JsonResponse($event);
    }

   public function getLast()
   {
       /** @var Event $event
        * Поиск последних записанных данных в базу
        * И показ, без записи в базу данных
        */
       $event = Event::query()->latest()->first();
       return new JsonResponse($event);
   }

    public function delete(int $id)
    {
        /**
         * Поиск по ключу id в базе данных Event и удаление данных с записью об успешном исходе
         * Плюс условие на возможность отсутствие данных по ключу
         */
        $event = Event::query()
            ->find($id);
        if ($event === null) {
            throw new NotFoundHttpException('Данных отсутствуют');
        }
        $event->delete();
        return new JsonResponse('Успешно удалено');
    }


    public function update(int $id, Request $request)
    {
        /** @var Event $event
         * Поиск данных по ключу id и обновленние данных
         */
        $event = Event::query()
            ->find($id);
        $requestData = $request->toArray();
        $event->event_time = Carbon::createFromFormat('Y-m-d H:i:s', $requestData['event_time']); // TODO обновлён формат даты создания
        $event->name = $requestData['name']; //TODO имя убрать в юзера urvUser
        $event->screen_url = $requestData['screen_url'];
        $event->screen_path = $requestData['screen_path'];
        $event->event_status_id = $requestData['status'];
        $urvObject = UrvObject::query()
            ->where('name', '=', $requestData['urv_object'])
            ->first();
        $event->urv_object()->associate($urvObject);
        $event->save();
    }

    public function getFromFirebird(Request $request) {
        $requestData = $request->toArray();
        /** @var UrvObject $urvObject
         * Выгрузка данных при помощи id прописанных в UrvObject
         * Добавление функции прописанной в config для подключения к
         * удалённой базе данных при помози firebird
         * применение метода gatLastEvent для выгрузки определённых данных, а не всего масива
         */
        $urvObject = UrvObject::query()->find($requestData['urv_object_id']);
        $config = $urvObject->config;
        $firebirdDB = FirebirdDataBase::create(
            login:    $config->firebird_login,
            password: $config->firebird_password,
            address:  $config->server_ip,
            mac:      $config->firebird_controller->mac
        );
        $firebirdData = $firebirdDB->getLastEvents($requestData['limit']);
        return new JsonResponse($firebirdData);
    }

}
