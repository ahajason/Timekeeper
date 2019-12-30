<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortraitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portraits', function (Blueprint $table) {
            $table->increments('portrait_id')->comment('头像Id');
            $table->unsignedInteger('user_id')->comment('所属用户Id');
            $table->string('portrait_path',50)->comment('头像存储路径');
            $table->unsignedTinyInteger('portrait_type')->comment('头像类型');
            $table->boolean('portrait_is_active')->comment('头像是否可用');
            $table->timestamp('portrait_created_at', 0)->nullable();
            $table->timestamp('portrait_updated_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portraits');
    }
}
