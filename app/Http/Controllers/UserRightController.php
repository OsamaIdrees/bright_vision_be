<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserRightController extends Controller
{
    //
    public function UserRight(Request $request){
        $user_id = $request['user_id'];
        $query = DB::table('user_crud_right')->select('add','update','delete')->where('id',$user_id)->get();
        return $query;


    }

    public function RightControl(Request $request){
        $name = $request['name'];
        $password = $request['password'];
        $staff_id = $request['staff_id'];
        $add_right = $request['add'];
        $update_right = $request['update'];
        $delete_right= $request['delete'];
        try {
            //code...
            $update_query = DB::table('user_crud_right')->where('id',$staff_id)->update(['add'=>$add_right,'update'=>$update_right,'delete'=>$delete_right]);
            $update_name_and_password =  DB::table('user')->where('id',$staff_id)->update(['name'=>$name,'password'=>$password]);
            return response()->json(['status'=>'Done','message'=>'Record Updated']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>'Fail','message'=>'Fail To Update']);
        }
    }

    public function getAllRequiredStaffInfo(Request $request){
        $user_id = $request['user_id'];
        $name_and_password = json_decode(DB::table('user')->where('id',$user_id)->select('name','password')->get(),true);
        $right_result = json_decode(DB::table('user_crud_right')->where('id',$user_id)->select('update','add','delete')->get(),true);
        $info  = [
            'name'=>$name_and_password[0]['name'],
            'password'=>$name_and_password[0]['password'],
            'add_right'=>$right_result[0]['add'],
            'update_right'=>$right_result[0]['update'],
            'delete_right'=>$right_result[0]['delete']
        ];
        return $info;
    }
}
