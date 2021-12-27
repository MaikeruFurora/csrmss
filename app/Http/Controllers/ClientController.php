<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\RegisterService;
use App\Models\User;
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

}
