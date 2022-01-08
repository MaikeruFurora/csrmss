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

class BaptismController extends Controller
{

    public function index(){
        $priests=Priest::all();
        return view('administrator/report/baptism/index',compact('priests'));
    }

    public function create(){
        return view('administrator/report/baptism/create');
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

    public function registerCreate(RegisterService $regiterservice){
        $clientData = Client::find($regiterservice->client_id);
        $data =Baptism::select('register_services.*','clients.*','baptisms.*')->join('register_services','baptisms.register_service_id','register_services.id')
                ->join('clients','register_services.client_id','clients.id')
                ->where('register_services.client_id',$clientData->id) 
                ->where('register_services.transaction_no',$regiterservice->transaction_no) 
                ->first();
        return view('administrator/register/partial/create-baptism',compact('clientData','regiterservice','data'));
    }

    public function store(Request $request){
        if (isset($request->id)) {
             $myTime=$this->getAvailDateSelected($request->scheduled_date);
             if (!$this->check_time_overlap($request->scheduled_time_form, $request->scheduled_time_to, $myTime)) {
                 return Baptism::whereId($request->id)->update([
                        'register_service_id'=>$request->register_service_id,
                            'child_first_name'=>$request->child_first_name,
                            'child_middle_name'=>$request->child_middle_name,
                            'child_last_name'=>$request->child_last_name,
                            'child_date_of_birth'=>$request->child_date_of_birth,
                            'child_gender'=>$request->child_gender,
                            'child_birth_of_place'=>$request->child_birth_of_place,
                            'child_complete_address'=>$request->child_complete_address,

                            'parent_mother_first_name'=>$request->parent_mother_first_name,
                            'parent_mother_middle_name'=>$request->parent_mother_middle_name,
                            'parent_mother_last_name'=>$request->parent_mother_last_name,
                            'parent_mother_contact_no'=>$request->parent_mother_contact_no,
                            'parent_father_first_name'=>$request->parent_father_first_name,
                            'parent_father_middle_name'=>$request->parent_father_middle_name,
                            'parent_father_last_name'=>$request->parent_father_last_name,
                            'parent_father_contact_no'=>$request->parent_father_contact_no,
                            'parent_complete_address'=>$request->parent_complete_address,

                            'god_father_first_name'=>$request->god_father_first_name,
                            'god_father_middle_name'=>$request->god_father_middle_name,
                            'god_father_last_name'=>$request->god_father_last_name,
                            'god_father_contact_no'=>$request->god_father_contact_no,
                            'god_father_complete_address'=>$request->god_father_complete_address,

                            'god_mother_first_name'=>$request->god_mother_first_name,
                            'god_mother_middle_name'=>$request->god_mother_middle_name,
                            'god_mother_last_name'=>$request->god_mother_last_name,
                            'god_mother_contact_no'=>$request->god_mother_contact_no,
                            'god_mother_complete_address'=>$request->god_mother_complete_address,
                            // 'baptized'=>$request->baptized,
                            

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
                 return Baptism::whereId($request->id)->update([
                        'register_service_id'=>$request->register_service_id,
                            'child_first_name'=>$request->child_first_name,
                            'child_middle_name'=>$request->child_middle_name,
                            'child_last_name'=>$request->child_last_name,
                            'child_date_of_birth'=>$request->child_date_of_birth,
                            'child_gender'=>$request->child_gender,
                            'child_birth_of_place'=>$request->child_birth_of_place,
                            'child_complete_address'=>$request->child_complete_address,

                            'parent_mother_first_name'=>$request->parent_mother_first_name,
                            'parent_mother_middle_name'=>$request->parent_mother_middle_name,
                            'parent_mother_last_name'=>$request->parent_mother_last_name,
                            'parent_mother_contact_no'=>$request->parent_mother_contact_no,
                            'parent_father_first_name'=>$request->parent_father_first_name,
                            'parent_father_middle_name'=>$request->parent_father_middle_name,
                            'parent_father_last_name'=>$request->parent_father_last_name,
                            'parent_father_contact_no'=>$request->parent_father_contact_no,
                            'parent_complete_address'=>$request->parent_complete_address,

                            'god_father_first_name'=>$request->god_father_first_name,
                            'god_father_middle_name'=>$request->god_father_middle_name,
                            'god_father_last_name'=>$request->god_father_last_name,
                            'god_father_contact_no'=>$request->god_father_contact_no,
                            'god_father_complete_address'=>$request->god_father_complete_address,

                            'god_mother_first_name'=>$request->god_mother_first_name,
                            'god_mother_middle_name'=>$request->god_mother_middle_name,
                            'god_mother_last_name'=>$request->god_mother_last_name,
                            'god_mother_contact_no'=>$request->god_mother_contact_no,
                            'god_mother_complete_address'=>$request->god_mother_complete_address,
                            // 'baptized'=>$request->baptized,
                            

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
            'data'=>Baptism::where('status','Pending')->get()
        ]);
    }

    public function approved(){
        return response()->json([
            'data'=>Baptism::where('status','Approved')->get()
        ]);
    }

    public function view(Baptism $baptism){
        return view('administrator/report/baptism/view',compact('baptism'));
    }

    public function destroy(Baptism $baptism){
        return $baptism->delete();
    }

    public function yesApproved(Baptism $baptism,$status){
         $baptism->status=$status;
         return $baptism->save();
    }

    public function print(Baptism $baptism,$register,$page,$priest){
        return view('administrator/report/baptism/print',compact('baptism','register','page','priest'));
    }

    public function updateBaptize(Baptism $baptism){
        $baptism->baptized=date("Y m d");
        return $baptism->save();
    }

    public function generateReport($from,$to){
        $startDate = date('Y-m-d', strtotime($from));
        $endDate = date('Y-m-d', strtotime($to));
        $baptism = Baptism::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
      
        $pdf = PDF::loadView('administrator/report/baptism/pdf',compact('baptism'));
        return $pdf->download('BAPTISM-GENERATE-DATE-'.date("F j, Y, g:i a").'.pdf');
      
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
