<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Priest;
use App\Models\RegisterService;
use App\Models\Wedding;
use Illuminate\Http\Request;
use PDF;

class WeddingController extends Controller
{
    public function index(){
        $priests=Priest::all();
        return view('administrator/report/wedding/index',compact('priests'));
    }

    public function create(){
        return view('administrator/report/wedding/create');
    }

    public function registerCreate(RegisterService $regiterservice){
        $clientData = Client::find($regiterservice->client_id);
        $data =Wedding::join('register_services','weddings.register_service_id','register_services.id')
                ->join('clients','register_services.client_id','clients.id')
                ->where('register_services.client_id',$clientData->id) 
                ->first();
        return view('administrator/register/partial/create-wedding',compact('clientData','regiterservice','data'));
    }
    
    public function store(Request $request){
        return Wedding::updateorcreate(['id'=>$request->id],[
            'register_service_id'=>$request->register_service_id,
            
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
    
    public function generateReport($from,$to){
        $startDate = date('Y-m-d', strtotime($from));
        $endDate = date('Y-m-d', strtotime($to));
        $wedding = Wedding::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
      
        $pdf = PDF::loadView('administrator/report/wedding/pdf',compact('wedding'));
        return $pdf->download('WEDDING-GENERATE-DATE-'.date("F j, Y, g:i a").'.pdf');
      
        // return view('administrator/report/baptism/pdf',compact('baptism'));
    }
}
