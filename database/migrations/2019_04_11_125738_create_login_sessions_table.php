<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_sessions', function (Blueprint $table) {
            $table->increments('session_id')->comment('登录会话Id');
            $table->unsignedInteger('user_id')->comment('所属用户Id');
            $table->string('token',50)->comment('访问令牌');
            $table->boolean('token_is_active')->default(false)->comment('访问令牌是否可用');
            $table->string('client_ip_address',30)->nullable()->comment('客户端IP地址');
            $table->text('client_user_agent',255)->nullable()->comment('客户端代理信息');
            $table->string('client_browser',30)->nullable()->comment('客户端浏览器');
            $table->string('client_browser_ver',30)->nullable()->comment('客户端浏览器版本');
            $table->string('client_os',30)->nullable()->comment('客户端操作系统');
            $table->string('client_os_ver',30)->nullable()->comment('客户端操作系统版本');
            $table->string('client_equipment',30)->nullable()->comment('客户端设备类型');
            $table->string('client_mobile_brand',30)->nullable()->comment('客户端手机品牌');
            $table->string('client_mobile_ver',30)->nullable()->comment('客户端手机型号');
            $table->timestamp('session_created_at', 0)->nullable();
            $table->timestamp('session_updated_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_sessions');
    }
}
