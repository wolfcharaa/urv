<?php

namespace App\Console\Commands;

use App\Models\Config;
use App\Models\Event;
use App\Models\UrvObject;
use App\Service\CameraImage\Trassir\TrassirImage;
use App\Service\Firebird\FirebirdData;
use App\Service\Firebird\FirebirdDataBase;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FirebirdInfoUpdate extends Command
{
    /**
     * Название команды в консоле.
     * @var string
     */
    protected $signature = 'firebird:update';

    /**
     * Описание команды при вызове функции help.
     * @var string
     */
    protected $description = 'обновляет базу данных информацией из firebird контроллеров';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** @var UrvObject $urvObject
         * Создание новой функции в консоли artisan
         */
        $urvObject = UrvObject::query()->find(1);
        $firebirdData = $this->requestFromFirebird($urvObject, 10);
        var_dump($firebirdData);
        $this->postSaveDatabaseFromFirebirdToUrvObject($firebirdData, $urvObject);
    }

    private function requestFromFirebird(UrvObject $urvObject, int $limit): array
    {
        /**
         * Применение метода config к базе данных объекта urvObject
         * Создание подключения к удалённой базе даннных
         * Выгрузка данных из базы данных при помощи контроллера FireBird
         * С условиямии прописанными в методе getLastEvents
         */
        $config = $urvObject->config;
        $firebirdDataBase = FirebirdDataBase::create(
            login:    $config->firebird_login,
            password: $config->firebird_password,
            address:  $config->server_ip,
            mac:      $config->firebird_controller->mac,
            port:     $config->firebird_port
        );
        return $firebirdDataBase->getLastEvents($limit);
    }

    /**
     * Поиск по всей базе данных после подключения к базе данных через контроллер Firebird ->
     * Создание и заполненние нового списка Event (объектов) с необходимыми нам полями, ассоциированая с классом
     * urv_object и дальнешее сохранение данных в таблице */
    private function postSaveDatabaseFromFirebirdToUrvObject(array $firebirdDataArray, UrvObject $urvObject)
    {
        /** @var FirebirdData $oneFireBirdData */
        foreach (array_reverse($firebirdDataArray) as $oneFireBirdData) {
            $uid = $urvObject->name . '_' . $oneFireBirdData->ID;
            $event = Event::query()->where('uid', '=', $uid)->first();
            if ($event !== null) {
                continue;
            }
            /** @var Config $config */
            $config = Config::query()->find(13);
            $event = new Event();
            $event->event_time = Carbon::createFromFormat('Y-m-d H:i:s', $oneFireBirdData->DT)->subSeconds(-$config->screen_delta_second);
            $event->name = $oneFireBirdData->FIO;
            $event->screen_url = '5464';
            $trassirImage = new TrassirImage($config->server_ip, $config->server_port, $config->sdk_password);
            $trassirImage->getImageLink($config->cam_guid, $event->event_time);
            $event->screen_path = $trassirImage->saveImageAndGetPath();
            $event->event_status_id = $oneFireBirdData->EVN;
            $event->uid = uniqid($uid);
            $event->urv_object()->associate($urvObject);
            $event->save();
        }
    }

}
