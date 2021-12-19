<?php

namespace App\Http\Controllers;

use App\Models\Confirmation;
use App\Models\Priest;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function index(){
        $priests=Priest::all();
        return view('administrator/report/confirmation/index',compact('priests'));
    }
    
    public function create(){
        return view('administrator/report/confirmation/create');
    }

    public function store(Request $request){
        return Confirmation::updateorcreate(['id'=>$request->id],[

            'confirmation_first_name'=>$request->confirmation_first_name,
            'confirmation_middle_name'=>$request->confirmation_middle_name,
            'confirmation_last_name'=>$request->confirmation_last_name,
            'confirmation_complete_address'=>$request->confirmation_complete_address,
            'confirmation_gender'=>$request->confirmation_gender,
            'confirmation_age'=>$request->confirmation_age,
            'confirmation_contact_no'=>$request->confirmation_contact_no,

            'start_date'=>$request->scheduled_date,
            'start_time'=>$request->scheduled_time_form,
            'end_date'=>$request->scheduled_date,
            'end_time'=>$request->scheduled_time_to,
            'confirm'=>$request->confirm,
            
        ]);
    }

    public function pending(){
        return response()->json([
            'data'=>Confirmation::where('status','Pending')->get()
        ]);
    }

    public function approved(){
        return response()->json([
            'data'=>Confirmation::where('status','Approved')->get()
        ]);
    }

    public function view(Confirmation $confirmation){
        return view('administrator/report/confirmation/view',compact('confirmation'));
    }

    public function destroy(Confirmation $confirmation){
        return $confirmation->delete();
    }

    public function yesApproved(Confirmation $confirmation,$status){
         $confirmation->status=$status;
         return $confirmation->save();
    }

    public function print(Confirmation $confirmation,$priest){
        return view('administrator/report/confirmation/print',compact('confirmation','priest'));
    }
}