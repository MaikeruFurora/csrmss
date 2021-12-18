<?php

namespace App\Http\Controllers;

use App\Models\Mass;
use App\Models\Priest;
use Illuminate\Http\Request;

class MassController extends Controller
{
    public function index(){
        $priests=Priest::all();
        return view('administrator/report/mass/index',compact('priests'));
    }
    
    public function create(){
        return view('administrator/report/mass/create');
    }

    public function store(Request $request){
        return Mass::updateorcreate(['id'=>$request->id],[

            'request_by'=>$request->request_by,
            'mass_first_name'=>$request->mass_first_name,
            'mass_middle_name'=>$request->mass_middle_name,
            'mass_last_name'=>$request->mass_last_name,
            'mass_option'=>$request->mass_option,

            'start_date'=>$request->scheduled_date,
            'start_time'=>$request->scheduled_time_form,
            'end_date'=>$request->scheduled_date,
            'end_time'=>$request->scheduled_time_to,
            
        ]);
    }

    public function pending(){
        return response()->json([
            'data'=>Mass::where('status','Pending')->get()
        ]);
    }

    public function approved(){
        return response()->json([
            'data'=>Mass::where('status','Approved')->get()
        ]);
    }

    public function view(Mass $mass){
        return view('administrator/report/mass/view',compact('mass'));
    }

    public function destroy(Mass $mass){
        return $mass->delete();
    }

    public function yesApproved(Mass $mass,$status){
         $mass->status=$status;
         return $mass->save();
    }

    public function print(Mass $mass,$priest){
        return view('administrator/report/mass/print',compact('mass','priest'));
    }

}
