<?php

namespace App\Http\Controllers;

use App\Models\RegisterService;
use Illuminate\Http\Request;

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
         RegisterService::create([
            'client_id'=>$request->client_id,
            'transaction_no'=>rand(100,999).'-'.rand(100,999),
            'service'=>$request->service,
            'schedule_date'=>$request->schedule_date,
        ]);

        return redirect()->route('client.requestClient');
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
}
