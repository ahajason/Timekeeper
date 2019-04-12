<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Icon
 *
 * @property int $icon_id 图标Id
 * @property string $icon_src 图标资源
 * @property int $icon_type 图标类型
 * @property int $icon_size 图标大小基准(%)
 * @property int $icon_order 图标排列顺序
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Icon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Icon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Icon query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Icon whereIconId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Icon whereIconOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Icon whereIconSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Icon whereIconSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Icon whereIconType($value)
 * @mixin \Eloquent
 */
class Icon extends Model
{
    //
}
