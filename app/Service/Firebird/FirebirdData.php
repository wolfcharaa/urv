<?php

namespace App\Service\Firebird;

/**
 * Полученные из базы данных firebird, данные
 * @property-read string ID порядковый номер внутри базы event
 * @property-read string DT время создания события
 * @property-read string EVN статус на объекте
 * @property-read string FIO Фамилия Имя Отчество
 */
class FirebirdData
{
    public string $ID;
    public string $DT;
    public string $EVN;
    public string $FIO;
}


//public function handle() {
///** @var UrvObject $urvObject */
//$urvObject = UrvObject::query()->find(1);
//$firebirdData = $this->getFromFirebird($urvObject, 10);
//$this->saveFirebirdDataToUrvDatabase($firebirdData, $urvObject);
//return 0;
//}
//
///**
// * @return FirebirdData[]
// */
//private function getFromFirebird(UrvObject $urvObject, int $limit): array {
//    $config = $urvObject->config;
//    $firebirdDB = FirebirdDataBase::create(
//        login:    $config->firebird_login,
//        password: $config->firebird_password,
//        address:  $config->server_ip,
//        mac:      $config->firebird_controller->mac
//    );
//    return $firebirdDB->getLastEvents($limit);
//}
//
//private function saveFirebirdDataToUrvDatabase(array $firebirdDataArray, UrvObject $urvObject) {
//    /** @var FirebirdData $oneFirebirdData */
//    foreach ($firebirdDataArray as $oneFirebirdData) {
//        $event = new Event();
//        $event->event_time = Carbon::createFromFormat('Y-m-d H:i:s', $oneFirebirdData->DT);
//        $event->name = $oneFirebirdData->FIO; //TODO имя убрать в юзера urvUser
//        $event->screen_url = '4444444'; //TODO
//        $event->screen_path = '777777777777'; //TODO
//        $event->event_status_id = $oneFirebirdData->EVN;
//        $event->urv_object()->associate($urvObject);
//        $event->save();
//    }
//}
