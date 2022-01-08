<?php

namespace App\Http\Controllers;

use App\Models\Baptism;
use App\Models\Burial;
use App\Models\Client;
use App\Models\Confirmation;
use App\Models\Mass;
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
        $data =Wedding::select('register_services.*','clients.*','weddings.*')->join('register_services','weddings.register_service_id','register_services.id')
                ->join('clients','register_services.client_id','clients.id')
                ->where('register_services.client_id',$clientData->id) 
                ->first();
        return view('administrator/register/partial/create-wedding',compact('clientData','regiterservice','data'));
    }
    
    public function getAvailDateSelected($date){
        $output1 = array();
        $output2 = array();
        $output3 = array();
        $output4 = array();
        $output5 = array();

        $wedding=Wedding::select('start_date','end_date','start_time','end_time')
        ->where('start_date',$date)
        ->get();
        foreach ($wedding as $key => $value) {
            $arr1=array();
            $arr1['start_time'] =  $value->start_time;
            $arr1['end_time'] =    $value->end_time;
            $output1[]=$arr1;
        }
        $burial=Burial::select('start_date','end_date','start_time','end_time')
        ->where('start_date',$date)
        ->get();
        foreach ($burial as $key => $value) {
            $arr2=array();
            $arr2['start_time'] =  $value->start_time;
            $arr2['end_time'] =    $value->end_time;
            $output2[]=$arr2;
        }

        $baptism=Baptism::select('start_date','end_date','start_time','end_time')
        ->where('start_date',$date)
        ->get();
        foreach ($baptism as $key => $value) {
            $arr3=array();
            $arr3['start_time'] =  $value->start_time;
            $arr3['end_time'] =    $value->end_time;
            $output3[]=$arr3;
        }

        $mass=Mass::select('start_date','end_date','start_time','end_time')
        ->where('start_date',$date)
        ->get();
        foreach ($mass as $key => $value) {
            $arr4=array();
            $arr4['start_time'] =  $value->start_time;
            $arr4['end_time'] =    $value->end_time;
            $output4[]=$arr4;
        }

        $confirmation=Confirmation::select('start_date','end_date','start_time','end_time')
        ->where('start_date',$date)
        ->get();
        foreach ($confirmation as $key => $value) {
            $arr5=array();
            $arr5['start_time'] =  $value->start_time;
            $arr5['end_time'] =    $value->end_time;
            $output5[]=$arr5;
        }
        $output = array_merge($output1,$output2,$output3,$output4,$output5);
        return $output;
    }

    public function store(Request $request){

        if (isset($request->id)) {
            $myTime=$this->getAvailDateSelected($request->scheduled_date);
            if (!$this->check_time_overlap($request->scheduled_time_form, $request->scheduled_time_to, $myTime)) {
                    $wed = Wedding::find($request->id);
                    $wed->register_service_id = $request->register_service_id;
                    $wed->bride_first_name = $request->bride_first_name;
                    $wed->bride_middle_name = $request->bride_middle_name;
                    $wed->bride_last_name = $request->bride_last_name;
                    $wed->bride_contact_no = $request->bride_contact_no;
                    $wed->bride_complete_address = $request->bride_complete_address;
                    $wed->groom_first_name = $request->groom_first_name;
                    $wed->groom_middle_name = $request->groom_middle_name;
                    $wed->groom_last_name = $request->groom_last_name;
                    $wed->groom_contact_no = $request->groom_contact_no;
                    $wed->groom_complete_address = $request->groom_complete_address;
                    $wed->start_date = $request->scheduled_date;
                    $wed->start_time = $request->scheduled_time_form;
                    $wed->end_date = $request->scheduled_date;
                    $wed->end_time = $request->scheduled_time_to;
                    return $wed->save();
            } else {
                return response()->json(['errTime' => "Conflict Time or Overlapping!!"]);
            }
        } else {
            $myTime=$this->getAvailDateSelected($request->scheduled_date);
            if (!$this->check_time_overlap($request->scheduled_time_form, $request->scheduled_time_to, $myTime)) {
                   return Wedding::create([
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
                            // 'married'=>$request->married,

                            
                            'start_date'=>$request->scheduled_date,
                            'start_time'=>$request->scheduled_time_form,
                            'end_date'=>$request->scheduled_date,
                            'end_time'=>$request->scheduled_time_to,
                            
                        ]);
            } else {
                return response()->json(['errTime' => "Conflict Time or Overlapping!!"]);
            }
        }
        
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

    public function check_time_overlap($psf, $pst, $arr)
    {
        //from POST
        $post_sched_from = strtotime($psf);
        $post_sched_to   = strtotime($pst);


        foreach ($arr as $key => $value) {
            //from DATABASE
            $db_sched_from = strtotime(explode(" ", $value['start_time'])[0]);
            $db_sched_to   = strtotime(explode(" ", $value['end_time'])[0]);
            $db_sched_to   = strtotime(explode(" ", $value->end_time)[0]);
            if ($db_sched_from > $post_sched_from && $db_sched_to < $post_sched_to) {
                // Check time is in between start and end time
                //  "1 Time is in between start and end time";
                return true;
            } elseif (($db_sched_from > $post_sched_from && $db_sched_from < $post_sched_to) || ($db_sched_to > $post_sched_from && $db_sched_to < $post_sched_to)) {
                // Check start or end time is in between start and end time
                //  "2 ChK start or end Time is in between start and end time";
                return true;
            } elseif ($db_sched_from == $post_sched_from || $db_sched_to == $post_sched_to) {
                // Check start or end time is at the border of start and end time
                //  "3 ChK start or end Time is at the border of start and end time";
                return true;
            } elseif ($post_sched_from > $db_sched_from && $post_sched_to < $db_sched_to) {
                // start and end time is in between  the check start and end time.
                //  "4 start and end Time is overlapping  chk start and end time";
                return true;
            }
        }

        return false;
    }
}
