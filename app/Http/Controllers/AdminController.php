<?php

namespace App\Http\Controllers;

use App\Models\Baptism;
use App\Models\Burial;
use App\Models\Confirmation;
use App\Models\Mass;
use App\Models\SystemProfile;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $baptismStat = Baptism::select(DB::raw("COUNT(if (status='Pending',1,NULL)) as Pending"), DB::raw("COUNT(if (status='Approved',1,NULL)) as Approved"))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->first();

        $weddingStat = Wedding::select(DB::raw("COUNT(if (status='Pending',1,NULL)) as Pending"), DB::raw("COUNT(if (status='Approved',1,NULL)) as Approved"))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->first();

        $burialStat = Burial::select(DB::raw("COUNT(if (status='Pending',1,NULL)) as Pending"), DB::raw("COUNT(if (status='Approved',1,NULL)) as Approved"))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->first();

        $massStat = Mass::select(DB::raw("COUNT(if (status='Pending',1,NULL)) as Pending"), DB::raw("COUNT(if (status='Approved',1,NULL)) as Approved"))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->first();

        $confirmationStat = Confirmation::select(DB::raw("COUNT(if (status='Pending',1,NULL)) as Pending"), DB::raw("COUNT(if (status='Approved',1,NULL)) as Approved"))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->first();

        // $startDate = date('Y-m-d', strtotime($from));
        // $endDate = date('Y-m-d', strtotime($to));
        // $event = Wedding::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
       return $event=$this->getAvailableDate();
        return view('administrator/dashboard',compact('baptismStat','weddingStat','burialStat','massStat','confirmationStat','event'));
    }


    public function getAvailableDate(){
        $output1 = array();
    $output2 = array();
    $output3 = array();
    $output4 = array();
    $output5 = array();

    $wedding=Wedding::select('bride_first_name','groom_first_name','start_date','end_date','start_time','end_time')
    ->where('start_date','>=', date('Y-m-d'))
    ->get();
    foreach ($wedding as $key => $value) {
        $arr1=array();
        $arr1['title'] =  'Wedding of '.$value->groom_first_name.' and '. $value->bride_first_name;
        $arr1['event'] =  'Wedding';
        $arr1['textColor'] =  'white';
        $arr1['start'] =  $value->start_date . ' ' . $value->start_time;
        $arr1['end'] =  $value->end_date . ' ' . $value->end_time;
        $output1[]=$arr1;
    }
    $burial=Burial::select('burial_first_name','start_date','end_date','start_time','end_time')
    ->where('start_date','>=', date('Y-m-d'))
    ->get();
    foreach ($burial as $key => $value) {
        $arr2=array();
        $arr2['title'] =  'Burial Mass of '.$value->burial_first_name;
        $arr2['event'] =  'Burial';
        $arr2['textColor'] =  'white';
        $arr2['start'] =  $value->start_date . ' ' . $value->start_time;
        $arr2['end'] =  $value->end_date . ' ' . $value->end_time;
        $output2[]=$arr2;
    }

    $baptism=Baptism::select('child_first_name','start_date','end_date','start_time','end_time')
    ->where('start_date','>=', date('Y-m-d'))
    ->get();
    foreach ($baptism as $key => $value) {
        $arr3=array();
        $arr3['title'] =  'Batism of '.$value->child_first_name;
        $arr3['event'] =  'Baptism';
        $arr3['textColor'] =  'white';
        $arr3['start'] =  $value->start_date . ' ' . $value->start_time;
        $arr3['end'] =  $value->end_date . ' ' . $value->end_time;
        $output3[]=$arr3;
    }

    $mass=Mass::select('request_by','start_date','end_date','start_time','end_time')
    ->where('start_date','>=', date('Y-m-d'))
    ->get();
    foreach ($mass as $key => $value) {
        $arr4=array();
        $arr4['title'] =  'Mass of '.$value->request_by;
        $arr4['event'] =  'Confirmation';
        $arr4['textColor'] =  'white';
        $arr4['start'] =  $value->start_date . ' ' . $value->start_time;
        $arr4['end'] =  $value->end_date . ' ' . $value->end_time;
        $output4[]=$arr4;
    }

    $confirmation=Confirmation::select('confirmation_first_name','start_date','end_date','start_time','end_time')
    ->where('start_date','>=', date('Y-m-d'))
    ->get();
    foreach ($confirmation as $key => $value) {
        $arr5=array();
        $arr5['title'] =  'Confirmation of '.$value->confirmation_first_name;
        $arr5['event'] =  'Confirmation';
        $arr5['textColor'] =  'white';
        $arr5['start'] =  $value->start_date . ' ' . $value->start_time;
        $arr5['end'] =  $value->end_date . ' ' . $value->end_time;
        $output5[]=$arr5;
    }


    $output = array_merge($output1,$output2,$output3,$output4,$output5);
    return response()->json($output);
    }

    public function registerClient(){
        return view('administrator/register/index');
    }

    public function priest(){
        return view('administrator/priest/index');
    }
    public function user(){
        return view('administrator/user/index');
    }

    public function schedule(){
        return view('administrator/schedule/index');
    }
   
    public function profile(){
        $data = SystemProfile::find(1);
        return view('administrator/profile/index',compact('data'));
    }

    public function profileStore(Request $request){
        // return $request->all();
        $data = $request->validate([
            'church_name' => 'required',
            'church_address' => 'required',
            // 'school_logo' => '',
        ]);

        if ($request->hasFile('church_logo')) {
            $this->deleteOldImage();
            $image = $request->file('church_logo');
            $imageName = rand(100,1000).rand(100,1000) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/'), $imageName);
            $data["church_logo"] = $imageName;
        } else {
            $resData = SystemProfile::find($request->id);
            $data["church_logo"] = !empty($resData->church_logo) ? $resData->church_logo : null;
        }

         SystemProfile::updateOrCreate(['id' => $request->id], $data);

         return back()->with('msg','System information updated successfully');
    }

    protected function deleteOldImage()
    {
        $sprofile = SystemProfile::find(1);
        if (!empty($sprofile->church_logo)) {
            return unlink(public_path('image/'.$sprofile->church_logo));
        }
      
    }

    public function finance(){
        return view('administrator/finance/index',);
    }
}
