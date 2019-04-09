<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id')->comment('用户Id');;
            $table->string('user_account',50)->unique()->comment('用户唯一账号');
            $table->string('user_password',50)->comment('密码');
            $table->string('user_nickname',50)->nullable()->comment('昵称');
            $table->string('user_email',50)->nullable()->comment('邮箱');
            $table->unsignedInteger('portrait_id')->comment('头像Id');
            $table->timestamp('user_created_at', 0)->nullable();
            $table->timestamp('user_updated_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
