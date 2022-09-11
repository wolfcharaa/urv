<?php

namespace App\Http\Controllers;

use App\Models\FirebirdController;
use Illuminate\Http\Request;

class FirebirdControllerController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->toArray();
        $firebirdController = new FirebirdController();
        $firebirdController->mac = $data['mac'];
        $firebirdController->status = $data['status'];
        $firebirdController->save();
    }

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
