<?php

namespace App\Http\Controllers;

use App\Models\Burial;
use App\Models\Priest;
use Illuminate\Http\Request;

class BurialController extends Controller
{
    public function index(){
        $priests=Priest::all();
        return view('administrator/report/burial/index',compact('priests'));
    }

    public function create(){
        return view('administrator/report/burial/create');
    }

    public function store(Request $request){
        return Burial::updateorcreate(['id'=>$request->id],[

            'burial_first_name'=>$request->burial_first_name,
            'burial_middle_name'=>$request->burial_middle_name,
            'burial_last_name'=>$request->burial_last_name,
            'burial_gender'=>$request->burial_gender,
            'burial_complete_address'=>$request->burial_complete_address,
            'burial_birth_of_date'=>$request->burial_birth_of_date,
            'burial_birth_of_place'=>$request->burial_birth_of_place,
            'burial_date_died'=>$request->burial_date_died,
            'burial_place_died'=>$request->burial_place_died,

            'start_date'=>$request->scheduled_date,
            'start_time'=>$request->scheduled_time_form,
            'end_date'=>$request->scheduled_date,
            'end_time'=>$request->scheduled_time_to,
            
        ]);
    }

    public function pending(){
        return response()->json([
            'data'=>Burial::where('status','Pending')->get()
        ]);
    }

    public function approved(){
        return response()->json([
            'data'=>Burial::where('status','Approved')->get()
        ]);
    }

    public function view(Burial $burial){
        return view('administrator/report/burial/view',compact('burial'));
    }

    public function destroy(Burial $burial){
        return $burial->delete();
    }

    public function yesApproved(Burial $burial,$status){
         $burial->status=$status;
         return $burial->save();
    }

    public function print(Burial $burial,$priest){
        return view('administrator/report/burial/print',compact('burial','priest'));
    }
   
}
