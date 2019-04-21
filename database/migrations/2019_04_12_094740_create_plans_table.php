<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('plan_id')->comment('事项Id');
            $table->string('plan_name',50)->comment('计划名称');
            $table->string('plan_generated_item_name',50)->comment('生成的事项名称');
            $table->unsignedInteger('plan_generated_item_interval')->comment('生成的事项时间间隔（秒/s）');
            $table->unsignedInteger('category_id')->comment('所属事项类别Id');
            $table->text('plan_description')->nullable()->comment('计划描述');
            $table->timestamp('plan_started_at', 0)->nullable()->comment('开始时间');
            $table->timestamp('plan_closed_at', 0)->nullable()->comment('结束时间');
            $table->timestamp('plan_created_at', 0)->nullable();
            $table->timestamp('plan_updated_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
