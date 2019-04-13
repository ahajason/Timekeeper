<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('item_id')->comment('事项Id');
            $table->string('item_sync_key',50)->unique()->comment('事项同步密钥');
            $table->string('item_name',50)->comment('事项名称');
            $table->integer('item_emergency_level')->comment('紧急程度');
            $table->integer('item_importance_level')->comment('重要程度');
            $table->integer('item_tomatoes')->default(0)->comment('番茄钟数量*10(避免精度丢失)');
            $table->unsignedTinyInteger('item_state')->default(0)->comment('事项事务状态');
            $table->unsignedInteger('category_id')->comment('所属事项类别Id');
            $table->unsignedInteger('plan_id')->nullable()->comment('所属计划Id');
            $table->unsignedInteger('item_forecast_time')->default(0)->comment('预计用时（秒/s）');
            $table->text('item_description')->nullable()->comment('事项描述');
            $table->timestamp('item_started_at', 0)->nullable()->comment('开始时间');
            $table->timestamp('item_closed_at', 0)->nullable()->comment('结束时间');
            $table->timestamp('item_created_at', 0)->nullable();
            $table->timestamp('item_updated_at', 0)->nullable();
            $table->index('item_state');
            $table->index('item_emergency_level');
            $table->index('item_importance_level');
            $table->index('category_id');
            $table->index('plan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
