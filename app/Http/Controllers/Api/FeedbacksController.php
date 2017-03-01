<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\UserFeedback;

class FeedbacksController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    * 
    */
    public function destroy($id)
    {
        //
    }
   
   
    /**
    * List Books from Users list
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
    public function addfeedback(Request $request)
    {
        // Get the request Data
        $feedbackData = $request->all();
        
        if(!isset($feedbackData["content"])) {
            $errorMsg = "参数丢失";
            return response()->json(['error' => $errorMsg], 400);
        }
        
        //Get User Information 
        $userId = Auth::id(); 
        $userName = Auth::user()->name;
        
        $feedbackData["user_id"] = (isset($feedbackData["user_id"])) ? $feedbackData["user_id"] : $userId ;
        $feedbackData["user_name"] = (isset($feedbackData["user_name"])) ? $feedbackData["user_name"] : $userName ;
                
        // Insert into the database the database
        try{
            UserFeedback::insert($feedbackData);
        } catch (Exception $ex) {
            return response()->json(['error' => "无法发布反馈: ".$ex->getMessage()], 400);
        }
        return response()->json(['msg' => 'success'], 200);     
    }
}