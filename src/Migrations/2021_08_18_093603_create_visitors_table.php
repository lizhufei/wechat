<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->char('nickname')->nullable()->comment('微信昵称');
            $table->char('name', 20)->nullable()->comment('姓名');
            $table->char('number', 20)->unique()->comment('访客编号');
            $table->tinyInteger('sex')->default(0)->comment('0保密1男2女');
            $table->char('identity', 20)->nullable()->comment('身份证');
            $table->char('phone', 11)->nullable()->comment('手机号');
            $table->string('head')->nullable()->comment('微信头像');
            $table->string('face')->nullable()->comment('人脸照');
            $table->tinyInteger('level')->default(1)->comment('1普通2VIP3特定');
            $table->char('plate', 10)->nullable()->comment('车牌号');
            $table->char('company_name', 50)->nullable()->comment('公司名称');
            $table->string('openid')->nullable()->comment('公众号OPENID');
            $table->tinyInteger('status')->default(1)->comment('0禁用1正常');

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
        Schema::dropIfExists('visitors');
    }
}
