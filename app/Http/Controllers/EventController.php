<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    public function add(Request $request) {
        $data = $request->toArray();
        $event = new Event();
        $event->event_time = $data['event_time'];
        $event->name = $data['name'];
        $event->screen_url = $data['screen_url'];
        $event->screen_path = $data['screen_path'];
        $event->save();
    }

    public function getAll() {
        return new JsonResponse(Event::all());
    }

    public function get(int $id) {
        $event = Event::query()->find($id);
        return new JsonResponse($event);
    }

   public function getLast(int $id)
   {
       // TODO дописать
       $event = Event::query()->find($id);
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


    public function update(Request $request, Event $event)
    {

    }

}
