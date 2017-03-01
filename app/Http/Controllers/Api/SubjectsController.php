<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Subject;
use Config;

class SubjectsController extends Controller
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
    * Get One or All Subjects
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
    public function getSubjects(Request $request) {
        $input = $request->all();
        $subjectId = (isset($input['subject_id']))? $input['subject_id'] : '';
        $module = (isset($input['module']))? $input['module'] : 'book';

        try {
            $subjects = ($subjectId == "")? Subject::where("module", $module)->get(['id', 'name','icon', 'position']) : Subject::where("id", $subjectId)->get(['id', 'name','icon', 'position']);
            if(!$subjects->count()) {
                return response()->json(array("data"=>array()), 200);     
            }

            return response()->json(['data'=>$subjects, 'fileUrl'=>Config::get('shaoshing_lifelong_learning_system.media_host')], 200);
        } catch (Exception $ex) {
            return response()->json(['error' => "无法获取结果: ".$ex->getMessage()], 400); 
        }
        
    }
}