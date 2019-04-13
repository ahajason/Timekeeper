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
 * @property \Illuminate\Support\Carbon|null $category_created_at
 * @property \Illuminate\Support\Carbon|null $category_updated_at
 * @property-read \App\Model\Icon $icon
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
    protected $fillable = [
        'user_id',
        'category_name',
        'category_color',
        'category_icon_id',
    ];
    protected $primaryKey = 'category_id';
    const CREATED_AT = 'category_created_at';
    const UPDATED_AT = 'category_updated_at';

    public function icon()
    {
        return $this->hasOne(Icon::class, 'icon_id', 'category_icon_id');
    }
    public function item()
    {
        return $this->hasMany(Item::class, 'category_id', 'category_id');
    }


//    public function portrait(){
//        return $this
//            ->hasOne(Portrait::class, 'user_id', 'user_id')
//            ->wherePortraitIsActive(true);
//    }
}
