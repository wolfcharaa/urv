<?php

namespace App\Http\Controllers;

use App\Models\UrvObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UrvObjectController extends Controller
{
    public function create(Request $request)
    {
        /**
         * Создание новых данных в базе
         */
        $requestData = $request->toArray();
        $urvObject = new UrvObject();
        $urvObject->name = $requestData['name'];
        $urvObject->description = $requestData['description'];
        $urvObject->address = $requestData['address'];
        $urvObject->save();
    }

    public function getOne(int $id)
    {
        /**
         * Запрос на вывод данных по заданному ID
         */
        $urvObject = UrvObject::query()->find($id);
        return new JsonResponse($urvObject);
    }

    public function getAll()
    {
        /**
         * Вывод всех данных в базе
         */
        return new JsonResponse(UrvObject::all());
    }

    public function update(int $id, Request $request)
    {
        /** @var UrvObject $urvObject
         * Обновление данных в определённом ID
         */
        $urvObject = UrvObject::query()
            ->find($id);
        $requestData = $request->toArray();
        $urvObject->name = $requestData['name']; //TODO имя убрать в юзера urvUser
        $urvObject->description = $requestData['description'];
        $urvObject->address = $requestData['address'];
        $urvObject->save();
    }

    public function delete(int $id)
    {
        /**
         * Поиск данных по заданному ID
         * И удаление его из базы
         */
        $urvObject = UrvObject::query()
            ->findOrFail($id);
        $urvObject->delete();
        return new JsonResponse('Успешно удалено');
    }

    public function checkFirebirdStatus(int $id) {
        /** @var UrvObject $urvObject
         * Проверка статуса объекта по заданному ID
         */
        $urvObject =  UrvObject::query()->find($id);
        $firebird = $urvObject->config->firebird_controller;
        return new JsonResponse($firebird->status);
    }
}
