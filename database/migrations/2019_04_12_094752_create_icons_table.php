<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icons', function (Blueprint $table) {
            $table->increments('icon_id')->comment('图标Id');
            $table->string('icon_src',50)->comment('图标资源');
            $table->unsignedTinyInteger('icon_type')->comment('图标类型');
            $table->integer('icon_size')->default(100)->comment('图标大小基准(%)');
            $table->unsignedInteger('icon_order')->comment('图标排列顺序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('icons');
    }
}
