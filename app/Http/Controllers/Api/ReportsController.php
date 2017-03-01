<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Backend\CreateReportsRequest;
use App\Http\Requests\Backend\UpdateReportsRequest;
use App\Repositories\Backend\ReportsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Auth;

class ReportsController extends AppBaseController
{
    /** @var  ReportsRepository */
    private $reportsRepository;

    public function __construct(ReportsRepository $reportsRepo)
    {
        $this->reportsRepository = $reportsRepo;
    }


    /**
     * Store a newly created Reports in storage.
     *
     * @param CreateReportsRequest $request
     *
     * @return Response
     */
    public function store(CreateReportsRequest $request)
    {
        $input = $request->all();
        $userId = Auth::user()->id;
        $fields = array_merge($input, array('user_id' => $userId));
        $reports = $this->reportsRepository->create($fields);
        if($reports) {
            return response()->json(['msg' => "success"], 200);
        } else {
            return response()->json(['error' => 'failed'], 400);
        }
    }
}
