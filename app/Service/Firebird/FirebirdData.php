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

