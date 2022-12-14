<?php

namespace App\Service\Firebird;

use Illuminate\Database\Connection;
use PDO;

class FirebirdDataBase
{
    private Connection $connection;
    private string $mac;

    /**
     * Данная функция создаёт подключение к базе данных контроллера firebird
     * @param string $login логин к базе данных
     * @param string $password пароль к базе данных
     * @param string $address домен или ip-адресс в формате address:port
     * @param string $mac мак адрес контроллера с УРВ
     * @param string $path путь к базе данных, по умолчанию как на виртуальной машин
     * @param int $port порт подключения к базе данных
     * @return FirebirdDataBase Подключение к базе данных
     */
    public static function create(string $login,
                                  string $password,
                                  string $address,
                                  string $mac,
                                  int    $port,
                                  string $path = 'C:\Program Files (x86)\ENT\Server\DB\CBASE.FDB'): FirebirdDataBase
    {
        $firebirdDataBase = new FirebirdDataBase();
        $firebirdDataBase->connect(
            login:      $login,
            password:   $password,
            address:    $address,
            port:       $port,
            mac:        $mac,
            path:       $path,
        );
        return $firebirdDataBase;
    }

    /**
     * Данная функция создаёт подключение к базе данных контроллера firebird
     * @param string $login логин к базе данных
     * @param string $password пароль к базе данных
     * @param string $address домен или ip-адресс в формате address:port
     * @param string $mac мак адрес контроллера с УРВ
     * @param string $path путь к базе данных, по умолчанию как на виртуальной машин
     * @return void
     */
    public function connect(string $login,
                            string $password,
                            string $address,
                            int    $port,
                            string $mac,
                            string $path = 'C:\Program Files (x86)\ENT\Server\DB\CBASE.FDB')
    {
        $pdo = new PDO('firebird:dbname=' . $address . '/' . $port . ':' . $path . ';charset=utf8', $login, $password);
        $this->mac = $mac;
        $this->connection = new Connection($pdo);
    }

    /**
     * Условие: Поиск интересующих нас данных из удалённой базы
     * Получение последних $limit значений
     * Использование новой фичи с добавлением точки с пробелами до и после для возможности использования переменных
     * @param int $limit Количество последних записей
     * @return FirebirdData[] Список из строчек таблицы в формате stdClass
     */
    public function getLastEvents(int $limit)
    {
        return $this->connection->select("
            SELECT FIRST " . $limit . "
                FB_EVN.ID , DT, EVN, FB_USR.FIO
            FROM FB_EVN INNER JOIN FB_USR
            ON FB_EVN.USR=FB_USR.ID
            WHERE  DVS = '". $this->mac ."'
            AND (EVN = 3 OR EVN = 5)
            ORDER BY FB_EVN.ID DESC"
        );
    }
}
