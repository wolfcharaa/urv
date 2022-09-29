<?php

namespace App\Http\Controllers;

use App\Models\UrvObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UrvObjectController extends Controller
{

    /** Создание новых данных в базе */
    public function create(Request $request)
    {
        $requestData = $request->toArray();
        $urvObject = new UrvObject();
        $urvObject->name = $requestData['name'];
        $urvObject->description = $requestData['description'];
        $urvObject->address = $requestData['address'];
        $urvObject->save();
    }

    /** Запрос на вывод данных по заданному ID */
    public function getOne(int $id)
    {
        $urvObject = UrvObject::query()->find($id);
        return new JsonResponse($urvObject);
    }

    /** Вывод всех данных в базе */
    public function getAll()
    {
        return new JsonResponse(UrvObject::all());
    }

    /** Обновление данных в определённом ID */
    public function update(int $id, Request $request)
    {
        /** @var UrvObject $urvObject */
        $urvObject = UrvObject::query()
            ->find($id);
        $requestData = $request->toArray();
        $urvObject->name = $requestData['name']; //TODO имя убрать в юзера urvUser
        $urvObject->description = $requestData['description'];
        $urvObject->address = $requestData['address'];
        $urvObject->save();
    }

    /** Поиск данных по заданному ID
     * И удаление его из базы */
    public function delete(int $id)
    {
        $urvObject = UrvObject::query()
            ->findOrFail($id);
        $urvObject->delete();
        return new JsonResponse('Успешно удалено');
    }


    /** Проверка статуса объекта по заданному ID */
    public function checkFirebirdStatus(int $id)
    {
        /** @var UrvObject $urvObject */
        $urvObject = UrvObject::query()->find($id);
        $firebird = $urvObject->config->firebird_controller;
        return new JsonResponse($firebird->status);
    }
}
