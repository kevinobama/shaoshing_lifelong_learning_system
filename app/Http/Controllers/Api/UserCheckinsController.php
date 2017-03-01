<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Backend\CreateUserCheckinsRequest;
use App\Http\Requests\Backend\UpdateUserCheckinsRequest;
use App\Repositories\Backend\UserCheckinsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;

class UserCheckinsController extends AppBaseController
{
    /** @var  UserCheckinsRepository */
    private $userCheckinsRepository;

    public function __construct(UserCheckinsRepository $userCheckinsRepo)
    {
        $this->userCheckinsRepository = $userCheckinsRepo;
    }


    /**
     * create or update checkins
     *
     * @param CreateUserCheckinsRequest $request
     *
     * @return Response
     */
    public function store(CreateUserCheckinsRequest $request)
    {
        $userId = Auth::id();
        if(empty($userId)) {
            $errorMsg = "user login required";
            return response()->json(['error' => $errorMsg], 400);
        }

        $checkin = $this->userCheckinsRepository->findByField('user_id', $userId)->first();

        $todayBegin     = strtotime(date('Y-m-d') . " 00:00:00");
        $yesterdayBegin = strtotime(date("Y-m-d", strtotime("-1 day")) . " 00:00:00");
        $yesterdayEnd   = strtotime(date("Y-m-d", strtotime("-1 day")) . " 23:59:59");
        $signedDays    = 1;
        $checkInCoins = config('shaoshing_lifelong_learning_system.checkInCoins');

        //create
        if ($checkin === null) {
            $fields =array(
                "user_id" => $userId,
                "signed_date_time" => time(),
                "signed_days" => $signedDays,
            );

            $checkin = $this->userCheckinsRepository->create($fields);
            if ($checkin) {
                $profile = UserProfile::find($userId);
                $profile->coin = $profile->coin + $checkInCoins;
                $profile->save();
            }
        } else {
            //update checkin datetime
            if ($checkin->signed_date_time < $todayBegin) {
                // continuous checkin
                if ($checkin->signed_date_time > $yesterdayBegin && $checkin->signed_date_time < $yesterdayEnd) {
                    $signedDays = $checkin->signed_days + 1;
                }

                $checkin->signed_date_time = time();
                $checkin->signed_days = $signedDays;
                $checkin->save();

                if ($checkin->save()) {
                    $profile = UserProfile::find($userId);
                    $profile->coin = $profile->coin + $checkInCoins;
                    $profile->save();
                }
            } else {
                return response()->json(['error' => 'signed_already'], 400);
            }
        }

        return response()->json(['msg' => 'Success','userCheckin' => $checkin], 200);
    }

    /**
     * Display the specified UserCheckins.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userId = Auth::id();
        if(empty($userId)) {
            $errorMsg = "user login required";
            return response()->json(['error' => $errorMsg], 400);
        }
        $todayBegin = strtotime(date('Y-m-d') . " 00:00:00");
        $userCheckin = $this->userCheckinsRepository->findByField('user_id', $userId)->first();
        $todayCheckin = false;

        if (empty($userCheckin)) {
            response()->json(['error' => 'User Checkins not found'], 400);
        } else {
            if ($userCheckin->signed_date_time > $todayBegin) {
                $todayCheckin = true;
            } else {
                $todayCheckin = false;
            }
        }

        return response()->json(['msg' => 'Success',
            'userCheckin' => $userCheckin,
            'todayCheckin' => $todayCheckin], 200);
    }
}
