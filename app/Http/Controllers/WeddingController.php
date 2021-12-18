<?php

namespace App\Http\Controllers;

use App\Models\Priest;
use App\Models\Wedding;
use Illuminate\Http\Request;

class WeddingController extends Controller
{
    public function index(){
        $priests=Priest::all();
        return view('administrator/report/wedding/index',compact('priests'));
    }

    public function create(){
        return view('administrator/report/wedding/create');
    }

    public function store(Request $request){
        return Wedding::updateorcreate(['id'=>$request->id],[

            'bride_first_name'=>$request->bride_first_name,
            'bride_middle_name'=>$request->bride_middle_name,
            'bride_last_name'=>$request->bride_last_name,
            'bride_contact_no'=>$request->bride_contact_no,
            'bride_complete_address'=>$request->bride_complete_address,


            'groom_first_name'=>$request->groom_first_name,
            'groom_middle_name'=>$request->groom_middle_name,
            'groom_last_name'=>$request->groom_last_name,
            'groom_contact_no'=>$request->groom_contact_no,
            'groom_complete_address'=>$request->groom_complete_address,
            'married'=>$request->married,

            
            'start_date'=>$request->scheduled_date,
            'start_time'=>$request->scheduled_time_form,
            'end_date'=>$request->scheduled_date,
            'end_time'=>$request->scheduled_time_to,
            
        ]);
    }

    public function pending(){
        return response()->json([
            'data'=>Wedding::where('status','Pending')->get()
        ]);
    }

    public function approved(){
        return response()->json([
            'data'=>Wedding::where('status','Approved')->get()
        ]);
    }

    public function view(Wedding $wedding){
        return view('administrator/report/wedding/view',compact('wedding'));
    }

    public function destroy(Wedding $wedding){
        return $wedding->delete();
    }

    public function print(Wedding $wedding,$priest){
        return view('administrator/report/wedding/print',compact('wedding','priest'));
    }

    public function yesApproved(Wedding $wedding,$status){
         $wedding->status=$status;
         return $wedding->save();
    }
}
