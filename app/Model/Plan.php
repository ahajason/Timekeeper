<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\Plan
 *
 * @property int $plan_id 事项Id
 * @property string $plan_name 计划名称
 * @property string $plan_generated_item_name 生成的事项名称
 * @property int $plan_generated_item_interval 生成的事项时间间隔（秒/s）
 * @property string|null $plan_description 计划描述
 * @property string|null $plan_started_at 开始时间
 * @property string|null $plan_closed_at 结束时间
 * @property string|null $plan_created_at
 * @property string|null $plan_updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan wherePlanClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan wherePlanCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan wherePlanDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan wherePlanGeneratedItemInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan wherePlanGeneratedItemName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan wherePlanName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan wherePlanStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Plan wherePlanUpdatedAt($value)
 * @mixin \Eloquent
 */
class Plan extends Model
{
    //
}
