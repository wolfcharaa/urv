<?php

namespace App\Http\Controllers;

use App\Models\FirebirdController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FirebirdControllerController extends Controller
{
    public function create(Request $request)
    {
        /**
         * Создание новых данных в базе
         */
        $data = $request->toArray();
        $firebirdController = new FirebirdController();
        $firebirdController->mac = $data['mac'];
        $firebirdController->status = $data['status'];
        $firebirdController->save();
        return new JsonResponse($firebirdController);
    }

    public function update(int $id, Request $request)
    {
        /** @var FirebirdController $firebirdController
         * Обновление данных по заданному ID
         */
        $firebirdController = FirebirdController::query()
            ->find($id);
        $requestData = $request->toArray();
        $firebirdController->mac = $requestData['mac'];
        $firebirdController->save();
    }
}
