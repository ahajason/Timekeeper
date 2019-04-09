<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Portrait
 *
 * @property int $portrait_id 头像Id
 * @property string $portrait_path 头像存储路径
 * @property string|null $portrait_url 头像地址
 * @property int $portrait_type 头像类型
 * @property string|null $portrait_created_at
 * @property string|null $portrait_updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Portrait wherePortraitUrl($value)
 * @mixin \Eloquent
 */
class Portrait extends Model
{
    //
}
