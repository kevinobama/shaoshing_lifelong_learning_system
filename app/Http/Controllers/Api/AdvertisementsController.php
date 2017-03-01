<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Config;
use Illuminate\Support\Facades\DB;

class AdvertisementsController extends Controller
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
    * 
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    * 
    */
    public function getAdvertisement(Request $request)
    {
        $advertisementParams = $request->all();
        $advertisementCount = (isset($advertisementParams['advertisement_count'])) ? $advertisementParams['advertisement_count'] : '';
        $id = (isset($advertisementParams['id'])) ? $advertisementParams['id'] : null;
        $block = (isset($advertisementParams['block'])) ? $advertisementParams['block'] : null;
        $advertisementResult= array();
        
        try {
            $advertisementQuery = DB::table('advertisements');
            $advertisementQuery->select(['name', 'image_link', 'redirect_link','block','module'])->where('is_active', 1)
            ->when($id, function ($query) use ($id) {
                return $query->where("id", $id);
            })
            ->when($block, function ($query) use ($block) {
                return $query->where("block", $block);
            })
            ->orderBy('priority', 'asc');

            if($advertisementCount != 0) {
                $advertisementQuery->limit($advertisementCount);
            }
            $advertisementResult["data"] = $advertisementQuery->get();    
            if(!$advertisementResult["data"]->count()) {
                return response()->json(array("data"=>array()), 200);     
            }
            $advertisementResult['fileUrl'] = Config::get('shaoshing_lifelong_learning_system.media_host');
            return response()->json($advertisementResult, 200); 
        } catch (Exception $ex) {
            return response()->json(['error' => "无法获取结果: ".$ex->getMessage()], 400); 
        }
    }
    
    
}