<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\TerminableMiddleware;
use Illuminate\Support\Facades\Log;
use Auth;
use Illuminate\Support\Facades\Redis;

class ApiMiddleware
{
    public $id;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $redis = Redis::connection();
        $apiLogsKeys = $redis->keys('shaoshing_lifelong_learning_system:edu_api_logs:*');
        if(count($apiLogsKeys) > 5000) {
            $redis->del($apiLogsKeys);
        }
        //$bearerToken = $request->bearerToken();
        $this->id = $maxId = $redis->get('shaoshing_lifelong_learning_system:edu_api_logs:max_id') + 1;

        $summary = $this->collectSummary($request, $response);
        if(env('apiLogFile')) {
            $indexFile = storage_path('logs/api/edu_api_logs_'.date('Y-m-d').'.data');
            $this->updateIndexFile($indexFile, $summary);
        }

//        //write redis
//        unset($summary['request']);
//        unset($summary['response']);
//
//        $redis->hMSet('shaoshing_lifelong_learning_system:edu_api_logs:'.$maxId, $summary);
//        $redis->hMSet('shaoshing_lifelong_learning_system:edu_api_logs:'.$maxId, array(
//              'request'=> json_encode(array_merge($request->all(), array('authorization'=> $bearerToken))),
//              'response'=> json_encode($response->getData()),
//        ));
        $redis->set('shaoshing_lifelong_learning_system:edu_api_logs:max_id', $maxId);
//        $redis->expireat('shaoshing_lifelong_learning_system:apiLogs:'.$maxId, strtotime("+1 week"));
    }

    /**
     * Updates index file with summary log data
     *
     * @param string $indexFile path to index file
     * @param array $summary summary log data
     */
    private function updateIndexFile($indexFile, $summary)
    {
        touch($indexFile);
        if (($fp = @fopen($indexFile, 'r+')) === false) {
            throw new InvalidConfigException("Unable to open debug data index file: $indexFile");
        }
        @flock($fp, LOCK_EX);
        $manifest = '';
        while (($buffer = fgets($fp)) !== false) {
            $manifest .= $buffer;
        }
        if (!feof($fp) || empty($manifest)) {
            // error while reading index data, ignore and create new
            $manifest = [];
        } else {
            $manifest = unserialize($manifest);
        }

        $manifest[$this->id] = $summary;

        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, serialize($manifest));

        @flock($fp, LOCK_UN);
        @fclose($fp);
    }

    /**
     * Collects summary data of current request.
     * @return array
     */
    protected function collectSummary($request, $response)
    {
        $summary = [
            'id' => $this->id,
            'url' => $request->url(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'time' => time(),
            'statusCode' => $response->status(),
            'userName' => Auth::check()? Auth::user()->name:'guest',
            'userID' =>  Auth::check()? Auth::id():'guestId',
            'request' => array_merge($request->all(), array('authorization'=> $request->bearerToken())),
            'response' => $response->getData(),
            'userAgent' => $request->header('User-Agent'),
        ];

        return $summary;
    }
}
