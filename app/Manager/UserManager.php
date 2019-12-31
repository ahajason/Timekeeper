<?php
/**
 * Created by Jason.
 * Date: 2019/4/11
 * Time: 20:39
 */

namespace App\Manager;


use App\Exceptions\ErrorCode;
use App\Model\LoginSession;
use Carbon\Carbon;
use Exception;

/**
 * Class UserManager
 * @package App\Manager
 */
class UserManager
{
    /**
     * createLoginSession
     * @param int $userId
     * @return string
     */
    public static function createLoginSession(int $userId)
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $token = md5(microtime(true) . mt_rand());
        $loginSession = self::getLoginSession($userId, $agent);
        if (empty($loginSession)) {
            $loginSession = new LoginSession();
            $loginSession->user_id = $userId;
            $loginSession->client_ip_address = $_SERVER['REMOTE_ADDR'];
            $loginSession->setClientInfo($agent);
        }
        $loginSession->token = $token;
        $loginSession->token_is_active = true;
        $loginSession->save();
        return $token;
    }

    /**
     * @param $userId
     * @param $token
     * @throws Exception
     */
    public static function verifyLoginSession($userId, $token)
    {
        $effectiveTime = Carbon::now()->subMonth()->toDateTimeString();//默认有效期一个月
        $loginSession = LoginSession::whereUserId($userId)
            ->whereToken($token)
            ->where('session_updated_at', '>=', $effectiveTime)
            ->whereTokenIsActive(true)
            ->first();
        if (empty($loginSession)) {
            throw new Exception('Token值无效或已过期', ErrorCode::ERROR_AUTH_FAIL);
        }
    }

    /**
     * @param int $userId
     * @param $agent
     * @return LoginSession|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function getLoginSession(int $userId, $agent)
    {
        return LoginSession::whereUserId($userId)
            ->whereClientUserAgent($agent)
            ->first();
    }
}