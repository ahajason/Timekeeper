<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Category
 *
 * @property int $category_id 类别Id
 * @property int $user_id 所属用户Id
 * @property string $category_name 类别名称
 * @property string $category_color 类别颜色
 * @property int $category_icon_id 类别图标Id
 * @property string|null $category_created_at
 * @property string|null $category_updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Category whereCategoryColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Category whereCategoryCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Category whereCategoryIconId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Category whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Category whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Category whereCategoryUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Category whereUserId($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    //
}
