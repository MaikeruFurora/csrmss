<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Client;
use App\Models\User;
use App\Notifications\NotifyAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\StatusNotifiation;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('auth/login');
    }

    public function store(Request $request){
        $credentials = $request->except(['_token']);
        if (Auth::guard('web')->attempt($credentials)) {
            Helper::myLog('login');
            return redirect()->route('admin.dashboard'); //if teacher or faculty
        } else {
            if (Auth::guard('client')->attempt($credentials)) {
                return redirect()->route('client.home'); //if student
            } else {
                return back();
            }
        }
    }

    public function register(){
        return view('auth/registerOne');
    }

     public function logout() {
        if (Auth::guard('web')->check()) {
            Helper::myLog('logout');
            Auth::guard('web')->logout();
        }
        if (Auth::guard('client')->check()) {
            Auth::guard('client')->logout();
        }
        return redirect()->route('welcome');
    }

    public function create(Request $request){
        $request->validate([
            'confirm_password'=>'same:password',
        ]);
        $registerClient  = Client::create([
            'fullname'=>$request->fullname,
            'contact_no'=>$request->contact_no,
            'email'=>$request->email,
            'username'=>strtolower($request->username),
            'address'=>$request->address,
            'password'=>Hash::make($request->password),
        ]);
        $data['for']='admin';
        $data['title']="New register user";
        $data['bodyMessage']="Hi, Admin you have new register user, ".$registerClient->fullname;
        $data['status']='new';
        $data['icon']='fa-user';
        $data['updated_at']=$registerClient->updated_at;
        $admins = User::all();
        $notifications = new NotifyAdmin($data);
        Notification::send($admins,$notifications);
        // $client->notify(new StatusNotifiation($data));

        if (Auth::guard('client')->attempt($request->only('username','password'))) {
            return redirect()->route('client.home'); //if admin
        }
        return back();
        
    }

    public function checkUsername($username){
        $data=Client::where('username',strtolower($username))->exists();
        if ($data) {
            return response()->json([
                'msg'=>'This username is already exist'
            ]);
        }
        
    }

}
