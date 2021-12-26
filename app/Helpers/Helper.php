<?php
namespace App\Helpers;

use App\Models\ActivityLog;

class Helper{
    public static function myLog($type=null,$table=null,$name=null){
        $log=null;
        switch ($type) {
            case 'delete':
                    $log= auth()->user()->name." delete one record: ".$table.", ".$name ." at ".date("F j, Y, g:i a");
                break;
            case 'create':
                    $log= auth()->user()->name." create one record: ".$table.", ".$name ." at ".date("F j, Y, g:i a");
                break;
            case 'update':
                    $log= auth()->user()->name." udpate one record: ".$table.", ".$name ." at ".date("F j, Y, g:i a");
                break;
            case 'export':
                    $log= auth()->user()->name." export ".$table.",".$name ." at ".date("F j, Y, g:i a");
                break;
            case 'import':
                    $log= auth()->user()->name." import ".$table.",".$name ." at ".date("F j, Y, g:i a");
                break;
            case 'reset':
                    $log= auth()->user()->name." reset one record: ".$table.", ".$name ." at ".date("F j, Y, g:i a");
                break;
            case 'archive':
                    $log= auth()->user()->name." archive one record: ".$table.", ".$name ." at ".date("F j, Y, g:i a");
                break;
            case 'restore':
                    $log= auth()->user()->name." restore one record: ".$table.", ".$name ." at ".date("F j, Y, g:i a");
                break;
            case 'login':
                    $log= auth()->user()->name." login at ".date("F j, Y, g:i a");
                break;
            case 'logout':
                    $log= auth()->user()->name." logout at ".date("F j, Y, g:i a");
                break;
            
            default:
                return false;
                break;
        }
        $activity_log = new ActivityLog();
    
        $activity_log->id=((rand(1000,10000)*rand(1,3)))-(rand(100,1000));
        
        $activity_log->log=$log;
    
        $activity_log->save();
        
    }
}