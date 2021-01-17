<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    //
    public function login(Request $request){
        $username = $request['username'];
        $password = $request['password'];
        $DbQuery = DB::table('user')->select('id','type')->where(['name'=>$username,'password'=>$password])->get();
        if(count($DbQuery)>0){
            return response()->json(['status'=>'Ok','message'=>'Login Successfull','Info'=>$DbQuery]);
        }
        else{
            return response()->json(['status'=>'Fail','message'=>'Login Failed']);
        }

    }

    public function getStaffUser(){
        $query = DB::table('user')->select('id','name')->where('type','staff')->get();
        return $query;
    }
    
}
