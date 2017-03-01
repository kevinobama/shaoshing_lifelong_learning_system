<?php
/**
 * Created by PhpStorm.
 * User: kevingates
 * Date: 10/24/16
 * Time: 10:21 AM
 */

namespace App\Helpers;

use config;
use Qiniu\Auth;

class QiniuHelper
{
    /**
     * token
     *
     */
    public static function token($bucket)
    {
        ob_end_clean();

        $accessKey = config('qiniu.access_key');
        $secretKey = config('qiniu.secret_key');

        $auth      = new Auth($accessKey, $secretKey);
        $bucket    = empty($bucket) ? config('qiniu.hooray-system.bucket') : $bucket;
        $token     = $auth->uploadToken($bucket);

        $tokenInfo['uptoken'] = $token;

        $str = 'abcdefghijkmnpqrstuvwxyz23456789';
        $tokenInfo['filename'] = $bucket . '_' . substr(str_shuffle($str), 0, 10) . "_" . time();
        $tokenInfo['url']      = config('qiniu.'.$bucket.'.url');

        return $tokenInfo;
    }
}