<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 * @property int $user_id 用户Id
 * @property string $user_account 用户唯一账号
 * @property string $user_password 密码
 * @property string|null $user_nickname 昵称
 * @property string|null $user_email 邮箱
 * @property int $portrait_id 头像Id
 * @property string|null $user_created_at
 * @property string|null $user_updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePortraitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserUpdatedAt($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
