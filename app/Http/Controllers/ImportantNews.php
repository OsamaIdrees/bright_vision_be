<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,DateTime;

class ImportantNews extends Controller
{
    //
    public function ImportantNews(Request $request){

            $dt = new DateTime;
            $news = $request['news'];
            $publishDate = $request['publish_date'];
            if($publishDate == ''){
                $publishDate = $dt->format('y-m-d');
            }
           
            $expirtDate = $request['expiryDate'];
            $dbQuery = DB::table('important_news')->insert(['news'=>$news,'publish_date'=>$publishDate,'expiry_date'=>$expirtDate]);
            if($dbQuery){
                return response()->json(['status'=>'ok','message'=>'News Added']);
            }
            else{
                return response()->json(['status'=>'fail','message'=>'Fail to Add']);
            }
           
            
    }
    public function GetImportantNews(){
        $dbQuery = DB::table('important_news')->select('*')->orderBy('id','desc')->get();
        return $dbQuery;
    }
    public function DeleteNews(Request $request){
        $d_id = $request['id'];
        $dbQuery = DB::table('important_news')->where('id',$d_id)->delete();
        if($dbQuery){
            return response()->json(['status'=>'ok','message'=>'News Delted']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'Fail to Delete']);
        }
    }

    public function UpdateNews(Request $request){
        $d_id = $request['id'];
        $news = $request['news'];
        $publishDate = $request['publish_date'];
        $expiryDate = $request['expiryDate'];
        $db_query = DB::table('important_news')->where('id',$d_id)->update(['news'=>$news,'expiry_date'=>$expiryDate,'publish_date'=>$publishDate]);
        if($db_query){
            return response()->json(['status'=>'ok','message'=>'Updated']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'Fail to Update']);
        }
    }

    public function getParticularNews(Request $request){
        $d_id = $request['id'];
        $dbQuery = DB::table('important_news')->select('*')->where('id',$d_id)->get();
        return $dbQuery;
    }

    public function setNewsNumber(Request $request){
        $number = $request['number'];
        $dbQuery = DB::table('important_news_number_update')->select('*')->get();
        $date = new DateTime;
        $today_date = $date->format('y-m-d h:i:s');
        if($dbQuery->count() == 0){
            $insertNumber = DB::table('important_news_number_update')->insert(['number'=>$number]);
            return response()->json(['status'=>'Done','message'=>'Successfull']);
        }
        else{
            $updateNumber = DB::table('important_news_number_update')->where('id',1)->update(['number'=>$number,'updated_at'=>$today_date]);
            return response()->json(['status'=>'Done','message'=>'Successfull']);
        }
        return response()->json(['status'=>'Fail','message'=>'Something Went Wrong']);
    }
    public function getNewsNumber(){
        $dbQuery = DB::table('important_news_number_update')->where('id',1)->pluck('number')->first();
        if($dbQuery){
            return response()->json(['status'=>'Done','number'=>$dbQuery]);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'Something Went Wrong']);
        }
    }
}

