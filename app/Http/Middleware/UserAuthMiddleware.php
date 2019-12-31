<?php

namespace App\Http\Middleware;

use App\Exceptions\ErrorCode;
use App\Manager\UserManager;
use App\Model\User;
use Auth;
use Closure;
use Exception;

class UserAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        $userId = $request['user_id'];
        $token = $request['token'];
        if (empty($userId) || empty($token)) {
            throw new Exception('权限参数缺失', ErrorCode::ERROR_AUTH_FAIL);
        }
        $user = User::whereUserId($userId)->first();
        if (empty($user)) {
            throw new Exception('用户不存在', ErrorCode::ERROR_AUTH_FAIL);
        }
        UserManager::verifyLoginSession($userId, $token);
        Auth::login($user);
        return $next($request);
    }
}
