<?php

namespace App\Service\Firebird;

/**
 * Полученные из бд firebird данные
 * @property-read string ID
 * @property-read string DT
 * @property-read string ENV
 * @property-read string FIO
 */
class FirebirdData
{
    public string $ID;
    public string $DT;
    public string $EVN;
    public string $FIO;
}
