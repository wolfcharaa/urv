<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\FirebirdController;
use App\Models\UrvObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ConfigController extends Controller
{
    public function getAll() {
        /** @var Config $config */
        $configs = Config::all();
        return view('configs', ['configs' => $configs]);
    }
    /**
     * Запрос в базу данных на вывод всех данный заданного ID
     */
    public function getOne(int $id) {
        /** @var UrvObject $urvObject */
        $urvObject = UrvObject::query()->find($id);
        $config = $urvObject->config;
        return new JsonResponse($config);
    }
    /**
     * Поиск по базе данных запрашиваемого ID
     *
     * Обновление-замена данных
     */
    public function update(int $id, Request $request) {
        $requestData = $request->toArray();
        /** @var UrvObject $urvObject */
        $urvObject = UrvObject::query()->find($id);
        /** @var Config $config */
        $config = $urvObject->config;
        $config->cam_guid = $requestData['cam_guid'];
        $config->server_ip = $requestData['server_ip'];
        $config->server_port = $requestData['server_port'];
        $config->sdk_password = $requestData['sdk_password'];
        $config->rtsp_port = $requestData['rtsp_port'];
        $config->database_ip = $requestData['database_ip'];
        $config->firebird_port = $requestData['firebird_port'];
        $config->firebird_login = $requestData['firebird_login'];
        $config->firebird_password = $requestData['firebird_password'];
        $config->screen_delta_second = $requestData['screen_delta_second'];
        $config->max_events_count = $requestData['max_events_count'];
        $firebirdController = FirebirdController::query()->findOrNew(['mac' => $requestData['mac']]);
        $config->firebird_controller = $firebirdController;
        return new JsonResponse($config);
    }


/** Поиск по базе данных заданного ID
 * При отстутсвии по заданному ID данных, создание новых
 */
    public function create(int $id, Request $request) {
        $requestData = $request->toArray();
        /** @var UrvObject $urvObject */
        $urvObject = UrvObject::query()->find($id);
        if ($urvObject === null) {
            throw new HttpException(418, 'Не найден объект с id ' . $id);
        }

        /** @var Config $config */
        $config = new Config();
        $config->cam_guid = $requestData['cam_guid'];
        $config->server_ip = $requestData['server_ip'];
        $config->server_port = $requestData['server_port'];
        $config->sdk_password = $requestData['sdk_password'];
        $config->rtsp_port = $requestData['rtsp_port'];
        $config->database_ip = $requestData['database_ip'];
        $config->firebird_port = $requestData['firebird_port'];
        $config->firebird_login = $requestData['firebird_login'];
        $config->firebird_password = $requestData['firebird_password'];
        $config->screen_delta_second = $requestData['screen_delta_second'];
        $config->max_events_count = $requestData['max_events_count'];
        $firebirdController = FirebirdController::query()->where(['mac' => $requestData['mac']])->first();
        if($firebirdController === null) {
            $firebirdController = new FirebirdController();
            $firebirdController->mac = $requestData['mac'];
            $firebirdController->save();
        }
        $config->urv_object()->associate($urvObject);
        $config->firebird_controller()->associate($firebirdController);
        $config->save();
        return new JsonResponse($config);
    }
}
