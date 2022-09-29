<?php

namespace App\Service\CameraImage\Trassir;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TrassirImage
{
    private int $port;
    private string $serverDomain;
    private string $password;
    private string $baseUrl;
    private string $link;
    private string $fullImageFolderName;
    private string $localPath = 'storage/image';

    public function __construct(string $serverDomain, string $port, string $password, string $imageFolderName = null)
    {
        $this->serverDomain = $serverDomain;
        $this->port = $port;
        $this->password = $password;
        $this->baseUrl = 'https://' . $this->serverDomain . ':' . $this->port;
        if ($imageFolderName === null) {
            $this->fullImageFolderName = Storage::path('public/image');
        } else {
            $this->fullImageFolderName = $imageFolderName;
        }
    }

    public function getImageLink(string $camGuid, Carbon $dateTime)
    {
        $this->link =
            $this->baseUrl .
            '/screenshot/' .
            $camGuid .
            '?timestamp=' . $dateTime->format("Ymd\THis") .
            '&sid=' . $this->getSid();
        return $this->link;
    }

    /**
     * Получает картинку из link и возвращает в base64, сохраняя в папку в imageFolderName
     * @return string
     */
    public function saveImageAndGetPath()
    {
        $response = Http::withoutVerifying()->get($this->link);
        $filename = uniqid(Carbon::now()->timestamp) . '.jpeg';
        file_put_contents($this->fullImageFolderName . '/' . $filename, $response->body());
        return $this->localPath . '/' . $filename;

    }


    private function getSid()
    {
        $response = Http::withoutVerifying()->get($this->baseUrl . '/login?password=' . $this->password);
        return json_decode($response->body(), true)['sid'];
    }

}

//class TrassirImage
//{
//    public static function getImageLink ($serverDomain, $port, $password) {
//        $sid =  json_decode(Http::withoutVerifying()->get('https://' . $serverDomain . ':' . $port . '/login?password=' . $password))['sid'];
//        $imageLink = Http::withoutVerifying()->get('');
//        return $imageLink;
//    }
//}
