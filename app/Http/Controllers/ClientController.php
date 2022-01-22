<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\RegisterService;
use App\Models\User;
use App\Models\Baptism;
use App\Models\Burial;
use App\Models\Confirmation;
use App\Models\Eventh;
use App\Models\Mass;
use App\Models\Wedding;
use App\Notifications\NotifyAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('client/index');
    }

    public function registerForm($type){
        $data =   RegisterService::select('service','schedule_date','status')
        ->join('clients','register_services.client_id','clients.id')
        ->where('clients.id',auth()->user()->id)
        ->where('register_services.service',$type)
        ->take(5)
        ->get();
        return view('client/requestForm',compact('type','data'));
    }
    public function requestClient(){
        return view('client/request');
    }

    public function registerStore(Request $request){
         $registerService = RegisterService::create([
            'client_id'=>$request->client_id,
            'transaction_no'=>rand(100,999).'-'.rand(100,999),
            'service'=>$request->service,
            'schedule_date'=>$request->schedule_date,
        ]);
        $data['for']='admin';
        $data['title']="New register user";
        $data['bodyMessage']="Hi, Admin; ".auth()->user()->fullname." register for ".$request->service." service.";
        $data['status']='service';
        $data['icon']=$this->myicon($request->service);
        $data['updated_at']=$registerService->updated_at;
        $admins = User::all();
        $notifications = new NotifyAdmin($data);
        Notification::send($admins,$notifications);
        return redirect()->route('client.requestClient');
    }

    public function myicon($service){
        switch ($service) {
            case 'Baptism':
                    return 'fa-baby';
                break;
            case 'Wedding':
                    return 'fa-female';
                break;
            case 'Confirmation':
                    return 'fa-sun';
                break;
            case 'Burial':
                    return 'fa-cross';
                break;
            case 'Mass':
                    return 'fa-church';
                break;
            default:
                return false;
                break;
        }
    }

    public function deleteReuqestService(RegisterService $registerService){
        return $registerService->delete();
    }

    public function requestList(){
        return response()->json(
            RegisterService::select('register_services.id','transaction_no','service','schedule_date','status','register_services.created_at')
            ->join('clients','register_services.client_id','clients.id')
            ->where('clients.id',auth()->user()->id)
            ->get()
        );
    }
    
    public function registerSlip(RegisterService $registerService){
        return view('client/slip',compact('registerService'));
    }

    public function clientList(){
        $data=array();
        $sqlData = Client::all();
            foreach ($sqlData as $key => $value) {
                $arr = array();
                $arr['id'] = ++$key;
                $arr['fullname'] = $value->fullname;
                $arr['address'] = $value->address;
                $arr['contact_no'] = $value->contact_no;
                $arr['email'] = $value->email;
                $arr['username'] = $value->username;
                $arr['date_registered'] = $value->created_at->diffForHumans();
                $data[] = $arr;
            }
        return response()->json([
            'data'=>$data
        ]);
    }

    public function notificationList(){
        return view('client/notification');
    }

    public function churchCalendar(){
        return view('client/churchCalendar');
    }

    public function getAvailableList(){


        $output1 = array();
        $output2 = array();
        $output3 = array();
        $output4 = array();
        $output5 = array();
        $output6 = array();
    
        $wedding=Wedding::select('start_date','end_date','start_time','end_time')->get();
        foreach ($wedding as $key => $value) {
            $arr1=array();
            $arr1['title'] =  'Wedding';
            $arr1['color'] =  'orange';
            $arr1['textColor'] =  'white';
            $arr1['start'] =  $value->start_date . ' ' . $value->start_time;
            $arr1['end'] =  $value->end_date . ' ' . $value->end_time;
            $output1[]=$arr1;
        }
        $burial=Burial::select('start_date','end_date','start_time','end_time')->get();
        foreach ($burial as $key => $value) {
            $arr2=array();
            $arr2['title'] =  'Burial';
            $arr2['color'] =  '#804000';
            $arr2['textColor'] =  'white';
            $arr2['start'] =  $value->start_date . ' ' . $value->start_time;
            $arr2['end'] =  $value->end_date . ' ' . $value->end_time;
            $output2[]=$arr2;
        }
    
        $baptism=Baptism::select('start_date','end_date','start_time','end_time')->get();
        foreach ($baptism as $key => $value) {
            $arr3=array();
            $arr3['title'] =  'Batism';
            $arr3['color'] =  'blue';
            $arr3['textColor'] =  'white';
            $arr3['start'] =  $value->start_date . ' ' . $value->start_time;
            $arr3['end'] =  $value->end_date . ' ' . $value->end_time;
            $output3[]=$arr3;
        }
    
        $mass=Mass::select('start_date','end_date','start_time','end_time')->get();
        foreach ($mass as $key => $value) {
            $arr4=array();
            $arr4['title'] =  'Mass';
            $arr4['color'] =  'green';
            $arr4['textColor'] =  'white';
            $arr4['start'] =  $value->start_date . ' ' . $value->start_time;
            $arr4['end'] =  $value->end_date . ' ' . $value->end_time;
            $output4[]=$arr4;
        }
    
        $confirmation=Confirmation::select('start_date','end_date','start_time','end_time')->get();
        foreach ($confirmation as $key => $value) {
            $arr5=array();
            $arr5['title'] =  'Confirmation';
            $arr5['color'] =  'violet';
            $arr5['textColor'] =  'white';
            $arr5['start'] =  $value->start_date . ' ' . $value->start_time;
            $arr5['end'] =  $value->end_date . ' ' . $value->end_time;
            $output5[]=$arr5;
        }
    
        $evenDate = Eventh::select("date_from", "date_to", "event")->where('status',1)->get();
        foreach ($evenDate as  $value) {
            $arr6 = array();
            $dateFrom = strval($value->date_from . ' ' . date("Y"));
            $dateTo = strval($value->date_to . ' ' . date("Y"));
            $arr6['start'] = date('Y-m-d', strtotime($dateFrom));
            if ($value->date_to != null) {
                $arr6['end'] =  date('Y-m-d', strtotime($dateTo . '+1 days'));
            }
            $arr6['title'] = $value->event;
            // $arr6['backgroundColor'] = "#9999ff";
            $arr6['color'] = "red";
            $arr6['textColor'] = "white";
            // $arr6['className'] = "holiday";
            $output6[] = $arr6;
        }
    
        $output = array_merge($output1,$output2,$output3,$output4,$output5,$output6);
        return response()->json($output);
       }
}
