<?php
/**
 * Created by Jason.
 * Date: 2019/4/11
 * Time: 20:39
 */

namespace App\Manager;


use App\Model\LoginSession;
use App\Utils\ClientInfoUtil;

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
        $ip = $_SERVER['REMOTE_ADDR'];
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $token = md5(microtime(true).mt_rand());
        $loginSession = LoginSession::whereUserId($userId)
            ->whereClientUserAgent($agent)
            ->first();
        if(empty($loginSession)){
            $clientInfo = ClientInfoUtil::getClientInfo($agent);
            LoginSession::create([
                'user_id' => $userId,
                'token' => $token,
                'token_is_active' => true,
                'client_ip_address' => $ip,
                'client_user_agent' => $agent,
                'client_browser' => $clientInfo['browser'],
                'client_browser_ver' => $clientInfo['browser_ver'],
                'client_os' => $clientInfo['os'],
                'client_os_ver' => $clientInfo['os_ver'],
                'client_equipment' => $clientInfo['equipment'],
                'client_mobile_brand' => $clientInfo['mobile_brand'],
                'client_mobile_ver' => $clientInfo['mobile_ver'],
            ]);
        }else{
            $loginSession->token = $token;
            $loginSession->token_is_active = true;
            $loginSession->save();
        }
        return $token;
    }
}