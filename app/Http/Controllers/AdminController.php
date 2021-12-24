<?php

namespace App\Http\Controllers;

use App\Models\Baptism;
use App\Models\Burial;
use App\Models\Confirmation;
use App\Models\Mass;
use App\Models\SystemProfile;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
         $baptismStat = Baptism::select('status',DB::raw('count(status) as total'))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->get();

        $weddingStat = Wedding::select('status',DB::raw('count(status) as total'))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->get();

        $burialStat = Burial::select('status',DB::raw('count(status) as total'))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->get();

        $massStat = Mass::select('status',DB::raw('count(status) as total'))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->get();

        $confirmationStat = Confirmation::select('status',DB::raw('count(status) as total'))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->get();

        // $startDate = date('Y-m-d', strtotime($from));
        // $endDate = date('Y-m-d', strtotime($to));
        // $event = Wedding::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
        $event=$this->getAvailableDate();
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
    ->where('status','Pending')
    ->get();
    foreach ($wedding as $key => $value) {
        $arr1=array();
        $arr1['name'] =  'Wedding of '.$value->groom_first_name.' and '. $value->bride_first_name;
        $arr1['icon'] =  'fa-female';
        $arr1['textColor'] =  'white';
        $arr1['start'] =  $value->start_date;
        $arr1['time'] =  $value->start_time . ' - ' . $value->end_time;
        $output1[]=$arr1;
    }
    $burial=Burial::select('burial_first_name','start_date','end_date','start_time','end_time')
    ->where('start_date','>=', date('Y-m-d'))
    ->where('status','Pending')
    ->get();
    foreach ($burial as $key => $value) {
        $arr2=array();
        $arr2['name'] =  'Burial Mass of '.$value->burial_first_name;
        $arr2['icon'] =  'fa-cross';
        $arr2['textColor'] =  'white';
        $arr2['start'] =  $value->start_date;
        $arr2['time'] =  $value->start_time . ' - ' . $value->end_time;
        $output2[]=$arr2;
    }

    $baptism=Baptism::select('child_first_name','child_last_name','child_middle_name','start_date','end_date','start_time','end_time')
    ->where('start_date','>=', date('Y-m-d'))
    ->where('status','Pending')
    ->get();
    foreach ($baptism as $key => $value) {
        $arr3=array();
        $arr3['name'] =  'Batism of '.$value->child_first_name.' '.$value->child_middle_name.' '.$value->child_last_name;
        $arr3['icon'] =  'fa-baby';
        $arr3['textColor'] =  'white';
        $arr3['start'] =  $value->start_date;
        $arr3['time'] =  $value->start_time . ' - ' . $value->end_time;
        $output3[]=$arr3;
    }

    $mass=Mass::select('request_by','start_date','end_date','start_time','end_time')
    ->where('start_date','>=', date('Y-m-d'))
    ->where('status','Pending')
    ->get();
    foreach ($mass as $key => $value) {
        $arr4=array();
        $arr4['name'] =  'Mass of '.$value->request_by;
        $arr4['icon'] =  'fa-church';
        $arr4['textColor'] =  'white';
        $arr4['start'] =  $value->start_date;
        $arr4['time'] =  $value->start_time . ' - ' . $value->end_time;
        $output4[]=$arr4;
    }

    $confirmation=Confirmation::select('confirmation_first_name','start_date','end_date','start_time','end_time')
    ->where('start_date','>=', date('Y-m-d'))
    ->where('status','Pending')
    ->get();
    foreach ($confirmation as $key => $value) {
        $arr5=array();
        $arr5['name'] =  'Confirmation of '.$value->confirmation_first_name;
        $arr5['icon'] =  'fa-sun';
        $arr5['textColor'] =  'white';
        $arr5['start'] =  $value->start_date;
        $arr5['time'] =  $value->start_time . ' ' . $value->end_time;
        $output5[]=$arr5;
    }


    $output = array_merge($output1,$output2,$output3,$output4,$output5);
    return $output;
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

    public function financeResult(Request $request,$type){
       switch ($type) {
           case 'Monthly':
                    return $this->monthlyFinance($request);
               break;
           case 'Annually':
                    return $this->annuallyFinance($request);
               break;
           case 'Date_Range':
                    return $this->dateRangeFinance($request);
                break;
           default:
                    return false;
               break;
       }
    }

    public function monthlyFinance($request){
        $monthCount=array();
        $bap = Baptism::selectRaw('COUNT(*) as count, MONTH(start_date) month')
        ->groupBy('month')->where('status','Approved')->get();
        $wed = Wedding::selectRaw('COUNT(*) as count, MONTH(start_date) month')
        ->groupBy('month')->where('status','Approved')->get();
        $con = Confirmation::selectRaw('COUNT(*) as count, MONTH(start_date) month')
        ->groupBy('month')->where('status','Approved')->get();
        $bur = Burial::selectRaw('COUNT(*) as count, MONTH(start_date) month')
        ->groupBy('month')->where('status','Approved')->get();
        $mas = Mass::selectRaw('COUNT(*) as count, MONTH(start_date) month')
        ->groupBy('month')->where('status','Approved')->get();
        

        $monthCount['baptism']=$this->whatMonth($bap,$request->month);
        $monthCount['wedding']=$this->whatMonth($wed,$request->month);
        $monthCount['confirmation']=$this->whatMonth($con,$request->month);
        $monthCount['burial']=$this->whatMonth($bur,$request->month);
        $monthCount['mass']=$this->whatMonth($mas,$request->month);
        return response()->json($monthCount);
    }

    public function annuallyFinance($request){
        $yearCount=array();
        $bap = Baptism::selectRaw('COUNT(*) as count, YEAR(start_date) year')
        ->groupBy('year')->where('status','Approved')->get();
        $wed = Wedding::selectRaw('COUNT(*) as count, YEAR(start_date) year')
        ->groupBy('year')->where('status','Approved')->get();
        $con = Confirmation::selectRaw('COUNT(*) as count, YEAR(start_date) year')
        ->groupBy('year')->where('status','Approved')->get();
        $bur = Burial::selectRaw('COUNT(*) as count, YEAR(start_date) year')
        ->groupBy('year')->where('status','Approved')->get();
        $mas = Mass::selectRaw('COUNT(*) as count, YEAR(start_date) year')
        ->groupBy('year')->where('status','Approved')->get();
        

        $yearCount['baptism']=$this->whatYear($bap,$request->year);
        $yearCount['wedding']=$this->whatYear($wed,$request->year);
        $yearCount['confirmation']=$this->whatYear($con,$request->year);
        $yearCount['burial']=$this->whatYear($bur,$request->year);
        $yearCount['mass']=$this->whatYear($mas,$request->year);
        return response()->json($yearCount);
    }

    public function dateRangeFinance($request){
        $startDate = date('Y-m-d', strtotime($request->from));
        $endDate = date('Y-m-d', strtotime($request->to));
        $dataRangeCount=array();
        $bap = Baptism::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
        $wed = Wedding::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
        $con = Confirmation::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
        $bur = Burial::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
        $mas = Mass::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
        

        $dataRangeCount['baptism']=$bap->count();
        $dataRangeCount['wedding']=$wed->count();
        $dataRangeCount['confirmation']=$con->count();
        $dataRangeCount['burial']=$bur->count();
        $dataRangeCount['mass']=$mas->count();
        return response()->json($dataRangeCount);
    }

    public function whatMonth($array,$month){
        foreach ($array as $value) {
            if ($value->month==$month) {
                return $value->count;
            }
        }   
    }

    public function whatYear($array,$year){
        foreach ($array as $value) {
            if ($value->year==$year) {
                return $value->count;
            }
        }   
    }

    public function financialReport($type){
        return view('administrator/finance/bap');
        // switch ($type) {
        //     case 'Monthly':
        //         break;
        //     case 'Annually':
        //         break;
        //     case 'Date_Range':
        //          break;
        //     default:
        //              return false;
        //         break;
        // }
    }

    public function archive(){
        return view('administrator/archives/index');
    }

}
