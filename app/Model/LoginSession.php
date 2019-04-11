<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\LoginSession
 *
 * @property int $session_id 登录会话Id
 * @property int $user_id 所属用户Id
 * @property string $token 访问令牌
 * @property int $token_is_active 访问令牌是否可用
 * @property string|null $client_ip_address 客户端IP地址
 * @property string|null $client_user_agent 客户端代理信息
 * @property string|null $client_browser 客户端浏览器
 * @property string|null $client_browser_ver 客户端浏览器版本
 * @property string|null $client_os 客户端操作系统
 * @property string|null $client_os_ver 客户端操作系统版本
 * @property string|null $client_equipment 客户端设备类型
 * @property string|null $client_mobile_brand 客户端手机品牌
 * @property string|null $client_mobile_ver 客户端手机型号
 * @property \Illuminate\Support\Carbon|null $session_created_at
 * @property \Illuminate\Support\Carbon|null $session_updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereClientBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereClientBrowserVer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereClientEquipment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereClientIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereClientMobileBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereClientMobileVer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereClientOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereClientOsVer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereClientUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereSessionCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereSessionUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereTokenIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LoginSession whereUserId($value)
 * @mixin \Eloquent
 */
class LoginSession extends Model
{
    protected $primaryKey = 'session_id';

    protected $fillable = [
        'user_id',
        'token',
        'token_is_active',
        'client_ip_address',
        'client_user_agent',
        'client_browser',
        'client_browser_ver',
        'client_os',
        'client_os_ver',
        'client_equipment',
        'client_mobile_brand',
        'client_mobile_ver',
    ];
    const CREATED_AT = 'session_created_at';
    const UPDATED_AT = 'session_updated_at';

}
