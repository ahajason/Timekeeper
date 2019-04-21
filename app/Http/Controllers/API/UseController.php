<?php

namespace App\Http\Controllers\API;

use App\Manager\PortraitManager;
use App\Manager\UserManager;
use App\Model\Category;
use App\Model\LoginSession;
use App\Model\Portrait;
use App\Model\User;
use Exception;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class UseController
 * @package App\Http\Controllers\API
 */
class UseController extends Controller
{


    /**
     * register
     * @param Request $request
     * @return array
     */
    public function register(Request $request)
    {
        $request->validate([
            'account' => 'required|max:50|min:3|unique:users,user_account',
            'password' => 'required|max:50|min:3',
        ]);
        $user = User::create([
            'user_account' => $request['account'],
            'user_password' => $request['password'],
            'user_nickname' => $request['account'],
        ]);
        $userId = $user->user_id;
        PortraitManager::generatePortrait($userId, $user->user_nickname);
        Category::create([
            'user_id' => $userId,
        ]);
        $token = UserManager::createLoginSession($userId);
        return ['success' => true, 'data' => ['user_id' => $userId, 'token' => $token]];
    }

    /**
     * login
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function login(Request $request)
    {
        $request->validate([
            'account' => 'required|max:50|min:3',
            'password' => 'required|max:50|min:3',
        ]);
        $userAccount = $request['account'];
        $userPassword = $request['password'];
        $user = User::whereUserAccount($userAccount)->whereUserPassword($userPassword)->first();
        if (empty($user)) {
            $user = User::whereUserEmail($userAccount)->whereUserPassword($userPassword)->first();
        }
        if (empty($user)) {
            throw new Exception('账号或密码错误');
        }
        $userId = $user->user_id;
        $token = UserManager::createLoginSession($userId);
        return ['success' => true, 'data' => ['user_id' => $userId, 'token' => $token]];
    }


    /**
     * getUserInfo
     * @param Request $request
     * @return array
     */
    public function getUserInfo(Request $request)
    {
        $user = Auth::user();
        $user->load('portrait');

        return ['success' => true, 'data' => ['user_info' => $user]];
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $userId = $user->user_id;
        $token = $request['token'];
        $loginSession = LoginSession::whereUserId($userId)
            ->whereToken($token)
            ->firstOrFail();
        $loginSession->token_is_active = false;
        $loginSession->save();
        return ['success' => true];
    }

}
