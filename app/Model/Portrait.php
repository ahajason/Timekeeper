<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Portrait
 *
 * @property int $portrait_id 头像Id
 * @property int $user_id 所属用户Id
 * @property string $portrait_path 头像存储路径
 * @property int $portrait_type 头像类型
 * @property int $portrait_is_active 头像是否可用
 * @property \Illuminate\Support\Carbon|null $portrait_created_at
 * @property \Illuminate\Support\Carbon|null $portrait_updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait whereUserId($value)
 * @mixin \Eloquent
 */
class Portrait extends Model
{
    const PORTRAIT_TYPE_NONE = 0;
    const PORTRAIT_TYPE_TEXT = 1;
    const PORTRAIT_TYPE_UPLOAD = 2;
    protected $primaryKey = 'portrait_id';
    protected $appends = ['portrait_url'];
    protected $fillable = [
        'user_id',
        'portrait_path',
        'portrait_type',
        'portrait_is_active'
    ];
    const CREATED_AT = 'portrait_created_at';
    const UPDATED_AT = 'portrait_updated_at';
    protected function getPortraitUrlAttribute()
    {
        return env('IMG_URL_PREFIX','/portrait?file=').$this->portrait_path;
    }


}
