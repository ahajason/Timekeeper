<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id')->comment('类别Id');
            $table->unsignedInteger('user_id')->comment('所属用户Id');
            $table->string('category_name',50)->comment('类别名称');
            $table->string('category_color')->comment('类别颜色');
            $table->unsignedInteger('category_icon_id')->comment('类别图标Id');
            $table->timestamp('category_created_at', 0)->nullable();
            $table->timestamp('category_updated_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
