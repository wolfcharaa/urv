<?php

namespace App\Console\Commands;

use App\Models\Config;
use App\Models\Event;
use App\Service\CameraImage\Trassir\TrassirImage;
use Illuminate\Console\Command;
use Carbon\Carbon;

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
        /** @var Config $config */
        $config = Config::query()->find(13);
        $test = new TrassirImage($config->server_ip, $config->server_port, $config->sdk_password);
        /** @var Event $event */
        $event = Event::query()->find(114);
        $test->getImageLink(
            $config->cam_guid, Carbon::createFromFormat('Y-m-d H:i:s', $event->event_time)
            ->subSeconds($config->screen_delta_second)
        );
        var_dump(
            $test->saveImageAndGetPath()
        );
    }
}
