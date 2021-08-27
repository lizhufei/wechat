<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessCodesTable extends Migration
{
    /**
     * 访客二维码
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_codes', function (Blueprint $table) {
            $table->id();
            $table->string('identify')->nullable()->comment('二维码识别码');
            $table->string('img')->nullable()->comment('二维码图片');
            $table->bigInteger('visitor_id')->comment('访客ID');
            $table->bigInteger('appointment_id')->comment('预约ID');
            $table->dateTime('start')->comment('预约开始时间');
            $table->dateTime('end')->comment('预约结束时间');
            $table->tinyInteger('status')->default(0)->comment('-1失效0待访问1已访问');
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
        Schema::dropIfExists('access_codes');
    }
}
