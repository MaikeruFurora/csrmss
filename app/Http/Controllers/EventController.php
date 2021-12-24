<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request){
        Event::updateorcreate(['id'=>$request->id],[
            'event'=>$request->event,
            'date_from'=>$request->date_from,
            'date_to'=>$request->date_to,
            'status'=>$request->status,
        ]);
    }

    public function list(){
        return response()->json([
            'data'=>Event::all()
        ]);
    }
    public function edit(Event $event){
        return response()->json($event);
    }
    public function destroy(Event $event){
        return $event->delete();
    }
}
