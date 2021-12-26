<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Priest;
use Illuminate\Http\Request;

class PriestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        return response()->json(
            Priest::all()
        );
    }

    public function store(Request $request){
        Helper::myLog('create','priest',$request->fullname);
        return Priest::updateorcreate(['id'=>$request->id],[
            'fullname'=>$request->fullname
        ]);
    }

    public function destroy(Priest $priest){
        Helper::myLog('archive','priest',$priest->fullname);
        return $priest->delete();
    }

    public function edit(Priest $priest){
        return response()->json($priest);
    }
    
}
