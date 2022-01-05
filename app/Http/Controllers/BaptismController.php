<?php

namespace App\Http\Controllers;

use App\Models\Baptism;
use App\Models\Client;
use App\Models\Priest;
use App\Models\RegisterService;
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

    public function registerCreate(RegisterService $regiterservice){
        $clientData = Client::find($regiterservice->client_id);
        $data =Baptism::join('register_services','baptisms.register_service_id','register_services.id')
                ->join('clients','register_services.client_id','clients.id')
                ->where('register_services.client_id',$clientData->id) 
                ->first();
        return view('administrator/register/partial/create-baptism',compact('clientData','regiterservice','data'));
    }

    public function store(Request $request){
        return Baptism::updateorcreate(['id'=>$request->id],[
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


}
