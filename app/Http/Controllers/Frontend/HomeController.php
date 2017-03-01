<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class HomeController extends AppBaseController
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the Home.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('frontend.homes.index')
            ->with('homes', '');
    }


}
