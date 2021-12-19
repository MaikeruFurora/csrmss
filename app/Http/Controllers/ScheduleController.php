<?php

namespace App\Http\Controllers;

use App\Models\Baptism;
use App\Models\Burial;
use App\Models\Confirmation;
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
        $arr2['color'] =  'gray';
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


    $output = array_merge($output1,$output2,$output3,$output4,$output5);
    return response()->json($output);

    // $lastDayOfMonth = $this->days_in_month(strval($month), date("Y"));
    // $lastDateOfMonth = "12/" . $lastDayOfMonth . date("/Y");
    // $firstDateOfMonth = date('m/') . "01" . date('/Y'); //, strtotime(' +1 day')
    // $currentDateNow = date("m/d/Y");
    // $data = Appointment::select('set_date as start', DB::raw('COUNT(set_date) as title')) //
    //     // ->where('set_date', '>=', $firstDateOfMonth)
    //     // ->where('set_date', '<=', $lastDateOfMonth)
    //     ->whereBetween('set_date', [$firstDateOfMonth, $lastDateOfMonth])
    //     ->groupBy('set_date')
    //     ->orderBy('set_date', 'asc')
    //     ->get();
    // $dataHoliday = Holiday::select("holi_date_from", "holi_date_to", "description")->get();
    // $arrayData0 = array();
    // foreach ($dataHoliday as  $value) {
    //     $arr = array();
    //     $dateFrom = strval($value->holi_date_from . ' ' . date("Y"));
    //     $dateTo = strval($value->holi_date_to . ' ' . date("Y"));
    //     $arr['start'] = date('Y-m-d', strtotime($dateFrom));
    //     if ($value->holi_date_to != null) {
    //         $arr['end'] =  date('Y-m-d', strtotime($dateTo . '+1 days'));
    //     }
    //     $arr['title'] = $value->description;
    //     $arr['backgroundColor'] = "#9999ff";
    //     $arr['borderColor'] = "rgba(0, 255, 0, 0)";
    //     $arr['textColor'] = "white";
    //     $arr['className'] = "holiday";
    //     $arrayData0[] = $arr;
    // }

    // $arrayData1 = array();

    // foreach ($data as $value) {
    //     $arr = array();
    //     $arr['start'] = date('Y-m-d', strtotime(strval($value->start)));
    //     $arr['title'] = "Total - " . $value->title;
    //     $arr['backgroundColor'] = $value->title >= 100 ? "rgba(0, 255, 0, 0)" : "#66cc66";
    //     $arr['borderColor'] = "rgba(0, 255, 0, 0)";
    //     $arr['textColor'] =  $value->title >= 100 ? "white" : "black";
    //     $arr['className'] = $value->title >= 100 ? "full" : "vacant";
    //     $arrayData1[] = $arr;
    // }
    // return response()->json(array_merge($arrayData0, $arrayData1));
   }
}
