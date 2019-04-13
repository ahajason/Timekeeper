<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\Item
 *
 * @property int $item_id 事项Id
 * @property string $item_sync_key 事项同步密钥
 * @property string $item_name 事项名称
 * @property int $item_emergency_level 紧急程度
 * @property int $item_importance_level 重要程度
 * @property int $item_tomatoes 番茄钟数量*10(避免精度丢失)
 * @property int $item_state 事项事务状态
 * @property int $category_id 所属事项类别Id
 * @property int|null $plan_id 所属计划Id
 * @property int $item_forecast_time 预计用时（秒/s）
 * @property string|null $item_description 事项描述
 * @property string|null $item_started_at 开始时间
 * @property string|null $item_closed_at 结束时间
 * @property \Illuminate\Support\Carbon|null $item_created_at
 * @property \Illuminate\Support\Carbon|null $item_updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemEmergencyLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemForecastTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemImportanceLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemSyncKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemTomatoes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item whereItemUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Item wherePlanId($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    const ITEM_STATE_TODO = 0;
    const ITEM_STATE_DOING = 1;
    const ITEM_STATE_DONE = 2;
    const ITEM_STATE_MAP = [
        self::ITEM_STATE_TODO => 'ITEM_STATE_TODO',
        self::ITEM_STATE_DOING => 'ITEM_STATE_DOING',
        self::ITEM_STATE_DONE => 'ITEM_STATE_DONE',
    ];
    const REVERSE_ITEM_STATE_MAP = [
        'ITEM_STATE_TODO' => self::ITEM_STATE_TODO,
        'ITEM_STATE_DOING' => self::ITEM_STATE_DOING,
        'ITEM_STATE_DONE' => self::ITEM_STATE_DONE,
    ];
    protected $fillable = [
        'item_sync_key',
        'item_name',
        'item_emergency_level',
        'item_importance_level',
        'item_state',
        'category_id',
        'item_state',
        'item_tomatoes',
        'item_forecast_time',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    protected $primaryKey = 'item_id';
    const CREATED_AT = 'item_created_at';
    const UPDATED_AT = 'item_updated_at';
}
