<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\User
 *
 * @property int $user_id 用户Id
 * @property string $user_account 用户唯一账号
 * @property string $user_password 密码
 * @property string|null $user_nickname 昵称
 * @property string|null $user_email 邮箱
 * @property int $portrait_id 头像Id
 * @property string|null $user_created_at
 * @property string|null $user_updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User wherePortraitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Model
{
    protected $hidden = [
        'password'
    ];
}
