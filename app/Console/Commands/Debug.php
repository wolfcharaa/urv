<?php

namespace App\Console\Commands;

use App\Service\Firebird\FirebirdDataBase;
use Illuminate\Console\Command;

class Debug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dbg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $test = FirebirdDataBase::create(
            login:    'sysdba',
            password: 'Request11',
            address:  'sophia.icstech.ru',
            mac:      '000B3A00347E');

        $events = $test->getLastEvents(5);
        $event = $events[0];


        print_r($events);
        print($event->DT);

    }
}
