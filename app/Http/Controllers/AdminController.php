<?php

namespace App\Http\Controllers;

use App\Models\Baptism;
use App\Models\Burial;
use App\Models\Mass;
use App\Models\SystemProfile;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $baptismStat = Baptism::select(DB::raw("COUNT(if (status='Pending',1,NULL)) as Pending"), DB::raw("COUNT(if (status='Approved',1,NULL)) as Approved"))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->first();

        $weddingStat = Wedding::select(DB::raw("COUNT(if (status='Pending',1,NULL)) as Pending"), DB::raw("COUNT(if (status='Approved',1,NULL)) as Approved"))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->first();

        $burialStat = Burial::select(DB::raw("COUNT(if (status='Pending',1,NULL)) as Pending"), DB::raw("COUNT(if (status='Approved',1,NULL)) as Approved"))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->first();

        $massStat = Mass::select(DB::raw("COUNT(if (status='Pending',1,NULL)) as Pending"), DB::raw("COUNT(if (status='Approved',1,NULL)) as Approved"))
        ->orderBy('status', 'asc')
        ->groupBy('status')
        ->first();

        return view('administrator/dashboard',compact('baptismStat','weddingStat','burialStat','massStat'));
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
}
