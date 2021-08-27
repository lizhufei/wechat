<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('official_menus', function (Blueprint $table) {
            $table->id();
            $table->char('name', 20)->comment('菜单名');
            $table->bigInteger('parent_id')->default(0)->comment('父ID');
            $table->char('key',20)->nullable()->comment('菜单KEY');
            $table->char('type', 20)->nullable()->comment('菜单类型');
            $table->string('url')->nullable()->comment('跳转地址');
            $table->integer('media_id')->nullable()->comment('media_id类型和view_limited类型必须');
            $table->string('appid')->nullable()->comment('miniprogram类型必须小程序的appid（仅认证公众号可配置）');
            $table->string('pagepath')->nullable()->comment('小程序的页面路径');
            $table->bigInteger('company_id')->nullable()->comment('公司ID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('official_menus');
    }
}
