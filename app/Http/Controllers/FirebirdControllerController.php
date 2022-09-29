<?php

namespace App\Http\Controllers;

use App\Models\FirebirdController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FirebirdControllerController extends Controller
{

    /** Создание новых данных в базе */
    public function create(Request $request)
    {
        $data = $request->toArray();
        $firebirdController = new FirebirdController();
        $firebirdController->mac = $data['mac'];
        $firebirdController->status = $data['status'];
        $firebirdController->save();
        return new JsonResponse($firebirdController);
    }

    /** Обновление данных по заданному ID */
    public function update(int $id, Request $request)
    {
        /** @var FirebirdController $firebirdController */
        $firebirdController = FirebirdController::query()
            ->find($id);
        $requestData = $request->toArray();
        $firebirdController->mac = $requestData['mac'];
        $firebirdController->save();
    }
}
