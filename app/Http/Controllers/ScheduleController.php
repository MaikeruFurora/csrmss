<?php

namespace App\Http\Controllers;

use App\Models\Baptism;
use App\Models\Burial;
use App\Models\Confirmation;
use App\Models\Eventh;
use App\Models\Mass;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    
   public function avaiable(){
        $lastDayOfMonth = $this->days_in_month(date('m'), date("Y"));
        $lastDateOfMonth = date("m/") . $lastDayOfMonth . date("/Y");
        $currentDate = date('m/d/Y'); //, strtotime(' +1 day')
        return response()->json(
            Baptism::select('schedule_date')
                ->whereBetween('schedule_date', [$currentDate, $lastDateOfMonth])
                ->groupBy('schedule_date')
                ->orderBy('schedule_date', 'asc')
                ->get()
        );
   } 

   public function getAvailableList(){


    $output1 = array();
    $output2 = array();
    $output3 = array();
    $output4 = array();
    $output5 = array();
    $output6 = array();

    $wedding=Wedding::select('bride_first_name','groom_first_name','start_date','end_date','start_time','end_time')->get();
    foreach ($wedding as $key => $value) {
        $arr1=array();
        $arr1['title'] =  'Wedding of '.$value->groom_first_name.' and '. $value->bride_first_name;
        $arr1['color'] =  'orange';
        $arr1['textColor'] =  'white';
        $arr1['start'] =  $value->start_date . ' ' . $value->start_time;
        $arr1['end'] =  $value->end_date . ' ' . $value->end_time;
        $output1[]=$arr1;
    }
    $burial=Burial::select('burial_first_name','start_date','end_date','start_time','end_time')->get();
    foreach ($burial as $key => $value) {
        $arr2=array();
        $arr2['title'] =  'Burial Mass of '.$value->burial_first_name;
        $arr2['color'] =  '#804000';
        $arr2['textColor'] =  'white';
        $arr2['start'] =  $value->start_date . ' ' . $value->start_time;
        $arr2['end'] =  $value->end_date . ' ' . $value->end_time;
        $output2[]=$arr2;
    }

    $baptism=Baptism::select('child_first_name','start_date','end_date','start_time','end_time')->get();
    foreach ($baptism as $key => $value) {
        $arr3=array();
        $arr3['title'] =  'Batism of '.$value->child_first_name;
        $arr3['color'] =  'blue';
        $arr3['textColor'] =  'white';
        $arr3['start'] =  $value->start_date . ' ' . $value->start_time;
        $arr3['end'] =  $value->end_date . ' ' . $value->end_time;
        $output3[]=$arr3;
    }

    $mass=Mass::select('request_by','start_date','end_date','start_time','end_time')->get();
    foreach ($mass as $key => $value) {
        $arr4=array();
        $arr4['title'] =  'Mass of '.$value->request_by;
        $arr4['color'] =  'green';
        $arr4['textColor'] =  'white';
        $arr4['start'] =  $value->start_date . ' ' . $value->start_time;
        $arr4['end'] =  $value->end_date . ' ' . $value->end_time;
        $output4[]=$arr4;
    }

    $confirmation=Confirmation::select('confirmation_first_name','start_date','end_date','start_time','end_time')->get();
    foreach ($confirmation as $key => $value) {
        $arr5=array();
        $arr5['title'] =  'Confirmationk of '.$value->confirmation_first_name;
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


   public function getAvilbleSelectedDate($dateSelected){
     $output1 = array();
        $output2 = array();
        $output3 = array();
        $output4 = array();
        $output5 = array();
        $output6 = array();
    
        $wedding=Wedding::select('start_date','end_date','start_time','end_time')->where('start_date','=', $dateSelected)->get();
        foreach ($wedding as $key => $value) {
            $arr1=array();
            $arr1['service'] =  'Wedding';
            $arr1['start'] =  date('h:i:s a', strtotime($value->start_time));
            $arr1['end'] =  date('h:i:s a', strtotime($value->end_time));
            $output1[]=$arr1;
        }
        $burial=Burial::select('start_date','end_date','start_time','end_time')->where('start_date','=', $dateSelected)->get();
        foreach ($burial as $key => $value) {
            $arr2=array();
            $arr2['service'] =  'Burial';
            $arr2['start'] =  date('h:i:s a', strtotime($value->start_time));
            $arr2['end'] =  date('h:i:s a', strtotime($value->end_time));
            $output2[]=$arr2;
        }
    
        $baptism=Baptism::select('start_date','end_date','start_time','end_time')->where('start_date','=', $dateSelected)->get();
        foreach ($baptism as $key => $value) {
            $arr3=array();
            $arr3['service'] =  'Batism';
            $arr3['start'] =  date('h:i:s a', strtotime($value->start_time));
            $arr3['end'] =  date('h:i:s a', strtotime($value->end_time));
            $output3[]=$arr3;
        }
    
        $mass=Mass::select('start_date','end_date','start_time','end_time')->where('start_date','=', $dateSelected)->get();
        foreach ($mass as $key => $value) {
            $arr4=array();
            $arr4['service'] =  'Mass';
            $arr4['start'] =  date('h:i:s a', strtotime($value->start_time));
            $arr4['end'] =  date('h:i:s a', strtotime($value->end_time));
            $output4[]=$arr4;
        }
    
        $confirmation=Confirmation::select('start_date','end_date','start_time','end_time')->where('start_date','=', $dateSelected)->get();
        foreach ($confirmation as $key => $value) {
            $arr5=array();
            $arr5['service'] =  'Confirmation';
            $arr5['start'] =  date('h:i:s a', strtotime($value->start_time));
            $arr5['end'] =  date('h:i:s a', strtotime($value->end_time));
            $output5[]=$arr5;
        }
    
        // $evenDate = Event::select("date_from", "date_to", "event")->where('status',1)->where('start_date','=', $dateSelected)->get();
        // foreach ($evenDate as  $value) {
        //     $arr6 = array();
        //     $dateFrom = strval($value->date_from . ' ' . date("Y"));
        //     $dateTo = strval($value->date_to . ' ' . date("Y"));
        //     $arr6['start'] = date('Y-m-d', strtotime($dateFrom));
        //     if ($value->date_to != null) {
        //         $arr6['end'] =  date('Y-m-d', strtotime($dateTo . '+1 days'));
        //     }
        //     $arr6['title'] = $value->event;
        //     $output6[] = $arr6;
        // }
    
        $output = array_merge($output1,$output2,$output3,$output4,$output5);
        return response()->json($output);

   }
}
