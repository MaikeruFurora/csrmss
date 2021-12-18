<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        return response()->json(
            User::all()
        );
    }

    public function store(Request $request){
        return User::updateorcreate(['id'=>$request->id],[
            'fullname'=>$request->fullname
        ]);
    }

    public function destroy(User $user){
        return $user->delete();
    }

    public function edit(User $user){
        return response()->json($user);
    }
}
