<?php

namespace App\Http\Controllers;

use App\Models\UrvObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UrvObjectController extends Controller
{
    public function create(Request $request)
    {
        $requestData = $request->toArray();
        $urvObject = new UrvObject();
        $urvObject->name = $requestData['name'];
        $urvObject->description = $requestData['description'];
        $urvObject->address = $requestData['address'];
        $urvObject->save();
    }

    public function getOne(int $id)
    {
        $urvObject = UrvObject::query()->find($id);
        return new JsonResponse($urvObject);
    }

    public function getAll()
    {
        return new JsonResponse(UrvObject::all());
    }

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

    public function delete(int $id)
    {
        $urvObject = UrvObject::query()
            ->findOrFail($id);
        $urvObject->delete();
        return new JsonResponse('Успешно удалено');
    }

    public function checkFirebirdStatus(int $id) {
        /** @var UrvObject $urvObject */
        $urvObject =  UrvObject::query()->find($id);
        $firebird = $urvObject->config->firebird_controller;
        return new JsonResponse($firebird->status);
    }
}
