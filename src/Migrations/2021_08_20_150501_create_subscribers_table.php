<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('person_id')->comment('员工ID');
            $table->char('nickname', 50)->nullable()->comment('微信昵称');
            $table->tinyInteger('sex')->default(0)->comment('0保密1男2女');
            $table->string('head')->nullable()->comment('头像');
            $table->string('openid')->unique()->comment('openid');
            $table->string('uuid')->nullable()->comment('uuid');
            $table->tinyInteger('attention')->default(1)->comment('0取消关注1已关注');
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
        Schema::dropIfExists('subscribers');
    }
}
