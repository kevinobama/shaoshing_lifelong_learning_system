<?php
/**
 * Created by PhpStorm.
 * User: kevingates
 * Date: 10/24/16
 * Time: 10:21 AM
 */

namespace App\Helpers;

use Log;
use Flash;
use Response;
use App\Models\UserProfile;
use App\Models\RolesUser;
use DB;
use Redirect;
use Illuminate\Support\Facades\Hash;

class UserHelper
{
    public static function create($roleName, $request, $studentsRepository)
    {
        $input = $request->all();

        if (!array_key_exists('name', $input) || empty($input['name'])) {
            return response()->json([
                'error' => "请输入用户名"
            ], 400);
        }

        if (!array_key_exists('password', $input) || empty($input['password'])) {
            return response()->json([
                'error' => "请输入密码"
            ], 400);
        }

        $fields = array('ip' => $_SERVER['REMOTE_ADDR'],
                        'last_login' => date('Y-m-d H:i:s'),
                        'password' => Hash::make($input['password'])
        );
        $count = $studentsRepository->findByField('name', $input['name'])->count();
        if($count > 0) {
            return response()->json([
                'error' => "用户已经注册"
            ], 400);
        } else {
            DB::beginTransaction();
            try {
                $user = $studentsRepository->create(array_merge($input,$fields));
                if ($roleName == 'student') {
                    UserProfile::create([
                            'user_id'=> $user->id,
                            'coin'=> 0,
                        ]
                    );
                }

                RolesUser::create([
                    'role_id' => ($roleName == 'student')? '1':'2',
                    'user_id' => $user->id
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'error' => $e->getMessage()
                ], 400);
            }

            return response()->json([
                'msg' => "register success"
            ], 200);
        }
    }
}