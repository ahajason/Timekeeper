<?php

namespace App\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\User
 *
 * @property int $user_id 用户Id
 * @property string $user_account 用户唯一账号
 * @property string $user_password 密码
 * @property string|null $user_nickname 昵称
 * @property string|null $user_email 邮箱
 * @property \Illuminate\Support\Carbon|null $user_created_at
 * @property \Illuminate\Support\Carbon|null $user_updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Model\Portrait $portrait
 */
class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    protected $fillable = ['user_account', 'user_password', 'user_nickname'];
    protected $hidden = ['user_password'];

    protected $primaryKey = 'user_id';
    const CREATED_AT = 'user_created_at';
    const UPDATED_AT = 'user_updated_at';

    public function portrait()
    {
        return $this
            ->hasOne(Portrait::class, 'user_id', 'user_id')
            ->wherePortraitIsActive(true);
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'user_id', 'user_id');
    }
}
