<?php

namespace App\Http\Controllers;

use App\Models\Eventh;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request){
        Eventh::updateorcreate(['id'=>$request->id],[
            'event'=>$request->event,
            'date_from'=>$request->date_from,
            'date_to'=>$request->date_to,
            'status'=>$request->status,
        ]);
    }

    public function list(){
        return response()->json([
            'data'=>Eventh::all()
        ]);
    }
    public function edit(Eventh $event){
        return response()->json($event);
    }
    public function destroy(Eventh $event){
        return $event->delete();
    }
}
