<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\RegisterService;
use Illuminate\Http\Request;
use App\Notifications\StatusNotifiation;
class RegisterServiceController extends Controller
{
    public function pending(){
        return response()->json(
           [
               'data'=> RegisterService::select('register_services.id','clients.fullname','clients.address','clients.contact_no','register_services.service','register_services.schedule_date','register_services.status','register_services.created_at')
               ->join('clients','register_services.client_id','clients.id')
               ->where('register_services.status','Pending')
               ->get()
           ]
        );
    }
    public function approved(){
        return response()->json(
          [
              'data'=>  RegisterService::select('register_services.id','clients.fullname','clients.address','clients.contact_no','register_services.service','register_services.schedule_date','register_services.status','register_services.created_at')
              ->join('clients','register_services.client_id','clients.id')
              ->where('register_services.status','Approved')
              ->get()
          ]
        );
    }

    public function destroy(RegisterService $registerService){
        return $registerService->delete();
    }

    public function yesApproved(RegisterService $registerService,$status){
        $registerService->status=$status;
        $this->partialNotify($registerService->id,$status);
         return $registerService->save();
    }
    public function partialNotify($id,$status){
    $data1= RegisterService::select('clients.id','clients.fullname','register_services.updated_at')
                                ->join('clients','register_services.client_id','clients.id')
                                ->where('register_services.id',$id)->first();
        if ($status=='Pending') {
            $bodyMessage="Hi,".$data1->fullname." your request was ".strtolower($status)." please sorry your schedule was not available";
        } else {
            $bodyMessage="Hi,".$data1->fullname." your request was ".strtolower($status)." please proceed to office for verification and details";
        }
        
       $data['for']='client';
       $data['title']="Request is ".strtoupper($status);
       $data['bodyMessage']=$bodyMessage;
       $data['status']=$status;
       $data['icon']=$status=='Pending'?'fa-times':'fa-check';
       $data['updated_at']=$data1->updated_at;
       $client=Client::whereId($data1->id)->first(); 
       $client->notify(new StatusNotifiation($data));
    }
}
