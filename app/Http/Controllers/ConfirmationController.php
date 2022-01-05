<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Confirmation;
use App\Models\Priest;
use App\Models\RegisterService;
use Illuminate\Http\Request;
use PDF;

class ConfirmationController extends Controller
{
    public function index(){
        $priests=Priest::all();
        return view('administrator/report/confirmation/index',compact('priests'));
    }
    
    public function create(){
        return view('administrator/report/confirmation/create');
    }

    public function registerCreate(RegisterService $regiterservice){
        $clientData = Client::find($regiterservice->client_id);
        $data =Confirmation::join('register_services','confirmations.register_service_id','register_services.id')
                ->join('clients','register_services.client_id','clients.id')
                ->where('register_services.client_id',$clientData->id) 
                ->first();
        return view('administrator/register/partial/create-confirmation',compact('clientData','regiterservice','data'));
    }

    public function store(Request $request){
        return Confirmation::updateorcreate(['id'=>$request->id],[
            'register_service_id'=>$request->register_service_id,
            
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
            // 'confirm'=>$request->confirm,
            
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

    public function generateReport($from,$to){
        $startDate = date('Y-m-d', strtotime($from));
        $endDate = date('Y-m-d', strtotime($to));
        $confirmation = Confirmation::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
      
        $pdf = PDF::loadView('administrator/report/confirmation/pdf',compact('confirmation'));
        return $pdf->download('CONFIRMATION-GENERATE-DATE-'.date("F j, Y, g:i a").'.pdf');
      
        // return view('administrator/report/baptism/pdf',compact('baptism'));
    }
}
