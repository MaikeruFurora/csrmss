<?php

namespace App\Http\Controllers;

use App\Models\Priest;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function archivePriest(){
        $data=array();
        $sqlData = Priest::onlyTrashed()->get();
        foreach ($sqlData as $key => $value) {
            $arr = array();
            $arr['i'] = ++$key;
            $arr['id'] = $value->id;
            $arr['fullname'] = $value->fullname;
            $arr['deleted_at'] = $value->deleted_at->diffForHumans();
            $arr['updated_at'] = $value->updated_at->format('F j, Y, g:i a');
            $data[] = $arr;
        }
        return response()->json(
           [ "data"=>$data]
        );
        
        return response()->json([
            'data'=>$data
        ]);
    }

    public function archivePriestRestore($priest){
        return Priest::whereId($priest)->withTrashed()->first()->restore();
    }
    public function archivePriestDelete($priest){
        return Priest::whereId($priest)->withTrashed()->first()->forceDelete();
    }
}
