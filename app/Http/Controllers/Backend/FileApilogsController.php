<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Redis;

class FileApilogsController extends AppBaseController
{
    /** @var  RedisApilogsRepository */
    public $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    /**
     * Display a listing of the RedisApilogs.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logs = $searchLogs = array();
        $indexFile = storage_path('logs/api/edu_api_logs_'.date('Y-m-d').'.data');
        if (($fp = @fopen($indexFile, 'r+')) === false) {            
            Flash::error("the file doesn't exist,Unable to open debug data index file: $indexFile");
        } else {
            $fileApilogs = '';
            while (($buffer = fgets($fp)) !== false) {
                $fileApilogs .= $buffer;
            }
            $logs = unserialize($fileApilogs);
            krsort($logs);
            @fclose($fp);            
        }
        
        $field = $request->field ? $request->field : null;
        $keyword = $request->keyword ? $request->keyword : null;

        if($field && $keyword) {
            foreach($logs as $key => $log) {
                if($field && $keyword && strpos($log[$field],$keyword) !== false) {
                    $searchLogs[] = $log;
                }
            }
            $logs = $searchLogs;
        }

        $total = count($logs);
        $fields = array(
            'url'=>'url',
            'userName'=>'userName',
            'tag' => 'tag',
            'method' => 'method',
            'ip' => 'ip',
            'statusCode' => 'statusCode',
            'userID' =>  'userID',
            'request' => 'userName',
        );

        return view('backend.file_api_logs.index')
            ->with('redisApilogs', $logs)
            ->with('fields',$fields)
            ->with('field',$field)
            ->with('keyword',$keyword)
            ->with('total', $total);
    }


    /**
     * Display the specified RedisApilogs.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $indexFile = storage_path('logs/api/edu_api_logs_'.date('Y-m-d').'.data');
        if (($fp = @fopen($indexFile, 'r+')) === false) {
            throw new InvalidConfigException("Unable to open debug data index file: $indexFile");
        }
        $fileApilogs = '';
        while (($buffer = fgets($fp)) !== false) {
            $fileApilogs .= $buffer;
        }
        $logs = unserialize($fileApilogs);

        @fclose($fp);

        $fileApilog = $logs[$id];
        if (empty($fileApilog)) {
            Flash::error('file Api log not found');

            return redirect(route('fileApilogs.index'));
        }

        return view('backend.file_api_logs.show')->with('fileApilog', $fileApilog);
    }

}
