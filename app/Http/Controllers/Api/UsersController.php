<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\UserHelper;
use App\Repositories\Backend\UsersRepository;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Parser;

class UsersController extends Controller
{
    /** @var  $usersRepository */
    private $usersRepository;

    public function __construct(UsersRepository $usersRepo)
    {
        $this->usersRepository = $usersRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function register(Request $request)
    {
        return UserHelper::create('student', $request, $this->usersRepository);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $user = $request->user()->load('profile', 'roles');

        if ($user) {
            return $user;
        } else {
            return response()->json([
                'error' => "Bad Request"
            ], 400);
        }
    }


    /**
     * update User Profile
     *
     * @param  int  $id, Request $request
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateUserProfile(Request $request)
    {
        // Get the request Data
        $requestData = $request->all();

        //Get User Information
        $userId = Auth::id();

        // If no parameters then return false
        if(count($requestData) == 0) {
            $errorMsg = "参数错误";
            return response()->json(['error' => $errorMsg], 400);
        }

        if(array_key_exists('phone_number', $requestData) && $requestData['phone_number']) {
            $user = User::findOrFail($userId);
            $user->update($requestData);
            unset($requestData['phone_number']);
        }

        $result = UserProfile::where('user_id', $userId)->update($requestData);
        if($result == 0||!$result) {
            $errorMsg = "update profile failed";
            return response()->json(['error' => $errorMsg], 400);
        }

        return ['code' => '200', 'msg' => 'Success'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id, Request $request
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        try {
            $bearerToken = $request->bearerToken();
            $tokenParse = (new Parser())->parse($bearerToken);
            $tokenId = $tokenParse->getClaim('jti');

            if (is_null($token = $request->user()->tokens->find($tokenId))) {
                return new Response('', 404);
            }

            $token->delete();

            return response()->json([
                'msg' => "退出成功"
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
