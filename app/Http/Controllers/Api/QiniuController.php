<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\QiniuHelper;

class QiniuController extends Controller
{
    /**
     * token
     *
     */
    public function token(Request $request)
    {
        $tokenInfo = QiniuHelper::token($request->bucket);

        return $tokenInfo;
    }
}