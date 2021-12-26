<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        Client::create([
            'fullname'=>$request->fullname,
            'contact_no'=>$request->contact_no,
            'email'=>$request->email,
            'username'=>$request->username,
            'address'=>$request->address,
            'password'=>Hash::make($request->password),
        ]);

        if (Auth::guard('client')->attempt($request->only('username','password'))) {
            return redirect()->route('client.home'); //if admin
        }
        return back();
        
    }

}
