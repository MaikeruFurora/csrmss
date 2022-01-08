<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Mail\MailNotify;
use App\Models\ActivityLog;
use App\Models\Baptism;
use App\Models\Burial;
use App\Models\Client;
use App\Models\Confirmation;
use App\Models\Mass;
use App\Models\RegisterService;
use App\Models\SystemProfile;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

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

        $Piedata = RegisterService::select('service',DB::raw('count(status) as total'))->groupBy('service')->get();
        // $startDate = date('Y-m-d', strtotime($from));
        // $endDate = date('Y-m-d', strtotime($to));
        // $event = Wedding::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status','Approved')->get();
        $event=$this->getAvailableDate();
        return view('administrator/dashboard',compact('baptismStat','weddingStat','burialStat','massStat','confirmationStat','event','Piedata'));
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
            $arr1['name'] =  'Wedding of '.$value->groom_first_name.' and '. $value->bride_first_name;
            $arr1['icon'] =  'fa-female';
            $arr1['textColor'] =  'white';
            $arr1['start'] =  $value->start_date;
            $arr1['time'] =  date('h:i:s a', strtotime($value->start_time)) . ' - ' . date('h:i:s a', strtotime($value->end_time));
            $output1[]=$arr1;
        }
        $burial=Burial::select('burial_first_name','start_date','end_date','start_time','end_time')
        ->where('start_date','>=', date('Y-m-d'))
        ->get();
        foreach ($burial as $key => $value) {
            $arr2=array();
            $arr2['name'] =  'Burial Mass of '.$value->burial_first_name;
            $arr2['icon'] =  'fa-cross';
            $arr2['textColor'] =  'white';
            $arr2['start'] =  $value->start_date;
            $arr2['time'] =  date('h:i:s a', strtotime($value->start_time)) . ' - ' . date('h:i:s a', strtotime($value->end_time));
            $output2[]=$arr2;
        }

        $baptism=Baptism::select('child_first_name','child_last_name','child_middle_name','start_date','end_date','start_time','end_time')
        ->where('start_date','>=', date('Y-m-d'))
        ->get();
        foreach ($baptism as $key => $value) {
            $arr3=array();
            $arr3['name'] =  'Batism of '.$value->child_first_name.' '.$value->child_middle_name.' '.$value->child_last_name;
            $arr3['icon'] =  'fa-baby';
            $arr3['textColor'] =  'white';
            $arr3['start'] =  $value->start_date;
            $arr3['time'] =  date('h:i:s a', strtotime($value->start_time)) . ' - ' . date('h:i:s a', strtotime($value->end_time));
            $output3[]=$arr3;
        }

        $mass=Mass::select('request_by','start_date','end_date','start_time','end_time')
        ->where('start_date','>=', date('Y-m-d'))
        ->get();
        foreach ($mass as $key => $value) {
            $arr4=array();
            $arr4['name'] =  'Mass of '.$value->request_by;
            $arr4['icon'] =  'fa-church';
            $arr4['textColor'] =  'white';
            $arr4['start'] =  $value->start_date;
            $arr4['time'] =  date('h:i:s a', strtotime($value->start_time)) . ' - ' . date('h:i:s a', strtotime($value->end_time));
            $output4[]=$arr4;
        }

        $confirmation=Confirmation::select('confirmation_first_name','start_date','end_date','start_time','end_time')
        ->where('start_date','>=', date('Y-m-d'))
        ->get();
        foreach ($confirmation as $key => $value) {
            $arr5=array();
            $arr5['name'] =  'Confirmation of '.$value->confirmation_first_name;
            $arr5['icon'] =  'fa-sun';
            $arr5['textColor'] =  'white';
            $arr5['start'] =  $value->start_date;
            $arr5['time'] =  date('h:i:s a', strtotime($value->start_time)) . ' - ' . date('h:i:s a', strtotime($value->end_time));
            $output5[]=$arr5;
        }
        $output = array_merge($output1,$output2,$output3,$output4,$output5);
        return $output;
    }

    public function registerClient(){
         $data1 = Baptism::select('register_service_id')->pluck('register_service_id');
         $data2 = Wedding::select('register_service_id')->pluck('register_service_id');
         $data3 = Confirmation::select('register_service_id')->pluck('register_service_id');
         $data4 = Burial::select('register_service_id')->pluck('register_service_id');
         $data5 = Mass::select('register_service_id')->pluck('register_service_id');
         $data = array_merge(json_decode($data1),json_decode($data2),json_decode($data3),json_decode($data4),json_decode($data5));
        return view('administrator/register/index',compact('data'));
    }


    public function sendEmail(Request $request){
        // return $request->all();
        if ($this->isOnline()) {
            return Mail::to($request->to)->send(new MailNotify($request));
        } else {
            return response()->json([
                'msg'=>'No internet connection, Please check your internet'
            ]);
        }
        
    }

    public function isOnline(){
        if (@fopen('https://www.google.com/',"r")) {
            return true;
        } else {
            return false;
        }
        
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
            'church_body' => 'required',
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

        if ($request->hasFile('church_image')) {
            $this->deleteOldImage();
            $imageI = $request->file('church_image');
            $imageIName = rand(100,1000).rand(100,1000) . '.' . $imageI->getClientOriginalExtension();
            $imageI->move(public_path('image/'), $imageIName);
            $data["church_image"] = $imageIName;
        } else {
            $resData = SystemProfile::find($request->id);
            $data["church_image"] = !empty($resData->church_image) ? $resData->church_image : null;
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
        $bap = Baptism::selectRaw('COUNT(*) as count, MONTH(start_date) month, YEAR(start_date) year')
        ->groupBy('month','year')->where('status','Approved')->get();
        $wed = Wedding::selectRaw('COUNT(*) as count, MONTH(start_date) month, YEAR(start_date) year')
        ->groupBy('month','year')->where('status','Approved')->get();
        $con = Confirmation::selectRaw('COUNT(*) as count, MONTH(start_date) month, YEAR(start_date) year')
        ->groupBy('month','year')->where('status','Approved')->get();
        $bur = Burial::selectRaw('COUNT(*) as count, MONTH(start_date) month, YEAR(start_date) year')
        ->groupBy('month','year')->where('status','Approved')->get();
        $mas = Mass::selectRaw('COUNT(*) as count, MONTH(start_date) month, YEAR(start_date) year')
        ->groupBy('month','year')->where('status','Approved')->get();
        

        $monthCount['baptism']=$this->whatMonth($bap,$request->month,$request->year);
        $monthCount['wedding']=$this->whatMonth($wed,$request->month,$request->year);
        $monthCount['confirmation']=$this->whatMonth($con,$request->month,$request->year);
        $monthCount['burial']=$this->whatMonth($bur,$request->month,$request->year);
        $monthCount['mass']=$this->whatMonth($mas,$request->month,$request->year);
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

    public function whatMonth($array,$month,$year){
        foreach ($array as $value) {
            if ($value->month==$month && $value->year==$year) {
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

    public function financialPDFReport($type,$logic){

        switch ($type) {
            case 'Monthly':
                    $data = explode("_",$logic);
                    $requestMonth=new Request();
                    $requestMonth->replace(['month'=>$data[0],'year'=>$data[1]]);
                    $data = json_decode($this->monthlyFinance($requestMonth)->getContent());
                    $pdf = PDF::loadView('administrator/finance/report',compact('data','type','logic'));
                    Helper::myLog('export','financial monthly report');
                    return $pdf->download('MONTHLY-REPORT-GENERATE-DATE-'.date("F j, Y, g:i a").'.pdf');
                break;
            case 'Annually':
                    $requestYear=new Request();
                    $requestYear->replace(['year'=>$logic]);
                    $data = json_decode($this->annuallyFinance($requestYear)->getContent());
                    $pdf = PDF::loadView('administrator/finance/report',compact('data','type','logic'));
                    Helper::myLog('export','financial yearly report');
                    return $pdf->download('ANUALLY-REPORT-GENERATE-DATE-'.date("F j, Y, g:i a").'.pdf');
                break;
            case 'Date_Range':
                     $data = explode("_",$logic);
                     $requestDateRange=new Request();
                     $requestDateRange->replace(['from'=>$data[0],'to'=>$data[1]]);
                    $data = json_decode($this->dateRangeFinance($requestDateRange)->getContent());
                    $pdf = PDF::loadView('administrator/finance/report',compact('data','type','logic'));
                    Helper::myLog('export','financial date selecteed');
                    return $pdf->download('DATE-RANGE-REPORT-GENERATE-DATE-'.date("F j, Y, g:i a").'.pdf');
                 break;
            default:
                     return false;
                break;
        }
    }

    public function archive(){
        return view('administrator/archives/index');
    }

    public function systemlog(){
        return view('administrator/systemlog/index');
    }

    public function searchByDate($from,$to){

        $data = array();
        if ($from=='null') {
            
            $sqlData = ActivityLog::get();
            foreach ($sqlData as $key => $value) {
                $arr = array();
                $arr['id'] = ++$key;
                $arr['log'] = $value->log;
                $arr['date'] = $value->created_at->diffForHumans();
                $data[] = $arr;
            }
            return response()->json(
               [ "data"=>$data]
            );
        } else {
            $startDate = date('Y-m-d', strtotime($from));
            $endDate = date('Y-m-d', strtotime($to));
            $sqlData = ActivityLog::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
            foreach ($sqlData as $key => $value) {
                $arr = array();
                $arr['id'] = ++$key;
                $arr['log'] = $value->log;
                $arr['date'] = $value->created_at->diffForHumans();
                $data[] = $arr;
            }
            return response()->json(
                ["data"=>$data]
            );
        }
        
       
    }

    public function notificationList(){
        return view('administrator/notifications/index');
    }
}
