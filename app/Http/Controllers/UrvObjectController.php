<?php

namespace App\Http\Controllers;

use App\Models\UrvObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UrvObjectController extends Controller
{
    public function create(Request $request) {
        $data = $request->toArray();
        $urv_object = new UrvObjectController();
        $urv_object->event_time = $data['event_time'];

        $urv_object->save();
    }

    public function getOne(int $id) {

    }

    public function getAll() {

    }

    public function update(int $id) {

    }

    public function delete(int $id) {

    }

    public function checkFirebirdStatus(int $id) {
        /** @var UrvObject $urvObject */
        $urvObject =  UrvObject::query()->find($id);
        $firebird = $urvObject->firebird_controller;
        return new JsonResponse($firebird->status);
    }
}
