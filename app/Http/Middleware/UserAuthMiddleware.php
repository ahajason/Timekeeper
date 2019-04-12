<?php

namespace App\Http\Middleware;

use App\Exceptions\ErrorCode;
use App\Model\LoginSession;
use App\Model\User;
use Carbon\Carbon;
use Closure;
use Exception;
use Auth;

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
        if (empty($userId)|| empty($token)){
            throw new Exception('权限参数缺失',ErrorCode::ERROR_AUTH_FAIL);
        }
        $user = User::whereUserId($userId)->first();
        if (empty($user)){
            throw new exception('用户不存在',ErrorCode::ERROR_AUTH_FAIL);
        }
        $effectiveTime = Carbon::now()->subMonth()->toDateTimeString();//默认有效期一个月
        $loginSession = LoginSession::whereUserId($userId)
            ->whereToken($token)
            ->where('session_updated_at','>=',$effectiveTime)
            ->whereTokenIsActive(true)
            ->first();
        if(empty($loginSession)){
            throw new exception('Token值无效或已过期',ErrorCode::ERROR_AUTH_FAIL);
        }
        Auth::login($user);
        return $next($request);
    }
}
