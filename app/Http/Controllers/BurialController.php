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
class BurialController extends Controller
{
    public function index(){
        $priests=Priest::all();
        return view('administrator/report/burial/index',compact('priests'));
    }

    public function create(){
        return view('administrator/report/burial/create');
    }
    
    public function registerCreate(RegisterService $regiterservice){
        $clientData = Client::find($regiterservice->client_id);
        $data =Burial::select('register_services.*','clients.*','burials.*')->join('register_services','burials.register_service_id','register_services.id')
                ->join('clients','register_services.client_id','clients.id')
                ->where('register_services.client_id',$clientData->id) 
                ->where('register_services.transaction_no',$regiterservice->transaction_no) 
                ->first();
        return view('administrator/register/partial/create-burial',compact('clientData','regiterservice','data'));
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
                 return Burial::whereId($request->id)->update([
                         'register_service_id'=>$request->register_service_id,
            
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
            } else {
                return response()->json(['errTime' => "Conflict Time or Overlapping!!"]);
            }
        } else {
            $myTime=$this->getAvailDateSelected($request->scheduled_date);
             if (!$this->check_time_overlap($request->scheduled_time_form, $request->scheduled_time_to, $myTime)) {
                 return Burial::whereId($request->id)->update([
                         'register_service_id'=>$request->register_service_id,
            
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
            } else {
                return response()->json(['errTime' => "Conflict Time or Overlapping!!"]);
            }
        }
     
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

    public function generateReport($from,$to){
        $startDate = date('Y-m-d', strtotime($from));
        $endDate = date('Y-m-d', strtotime($to));
        $burial = Burial::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
      
        $pdf = PDF::loadView('administrator/report/burial/pdf',compact('burial'));
        return $pdf->download('BURIAL-GENERATE-DATE-'.date("F j, Y, g:i a").'.pdf');
      
        // return view('administrator/report/baptism/pdf',compact('burial'));
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
