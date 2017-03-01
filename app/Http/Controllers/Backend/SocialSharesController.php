<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;

class SocialSharesController extends Controller
{
    /**
     * Display a listing of the Books.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->os == 'ios') {
            $downloadUrl = Config::get('shaoshing_lifelong_learning_system.appDownloadUrl.iosUrl');
        } else {
            $downloadUrl = Config::get('shaoshing_lifelong_learning_system.appDownloadUrl.androidUrl');
        }


        return view('backend.social_shares.index')->with('downloadUrl', $downloadUrl);
    }
}
