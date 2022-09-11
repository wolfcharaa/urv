<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\UrvObject;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    public function create(Request $request) {
        $requestData = $request->toArray();
        $event = new Event();
        $event->event_time = Carbon::createFromFormat('Y/m/d', $requestData['event_time']);
        $event->name = $requestData['name']; //TODO имя убрать в юзера urvUser
        $event->screen_url = $requestData['screen_url'];
        $event->screen_path = $requestData['screen_path'];
        $event->event_status_id = $requestData['status'];
        $urvObject = UrvObject::query()
            ->where('name', '=', $requestData['urv_object'])
            ->first();
        $event->urv_object()->associate($urvObject);
        $event->save();
    }

    public function getAll() {
        return new JsonResponse(Event::all());
    }

    public function get(int $id) {
        $event = Event::query()->find($id);
        return new JsonResponse($event);
    }

   public function getLast()
   {
       $event = Event::query()->latest()->first();
       return new JsonResponse($event);
   }

    public function delete(int $id) {
        $event = Event::query()
            ->find($id);
        if ($event === null) {
            throw new NotFoundHttpException('Данных отсутствуют');
        }
        $event->delete();
        return new JsonResponse('Успешно удалено');
    }


    public function update(int $id, Request $request)
    {
        $event = Event::query()
            ->find($id);
        $requestData = $request->toArray();
        $event->event_time = Carbon::createFromFormat('Y/m/d', $requestData['event_time']);
        $event->name = $requestData['name']; //TODO имя убрать в юзера urvUser
        $event->screen_url = $requestData['screen_url'];
        $event->screen_path = $requestData['screen_path'];
        $event->event_status_id = $requestData['status'];
        $urvObject = UrvObject::query()
            ->where('name', '=', $requestData['urv_object'])
            ->first();
        $event->urv_object()->associate($urvObject);
        $event->save();
    }

}
