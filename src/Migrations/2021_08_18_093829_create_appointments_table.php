<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * 预约表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('visitor_id')->comment('访客ID');
            $table->bigInteger('person_id')->comment('被访者ID');
            $table->bigInteger('company_id')->nullable()->comment('公司ID');
            $table->integer('peoples')->nullable()->comment('来访人数');
            $table->string('reason')->nullable()->comment('来访事由');
            $table->char('plate',10)->nullable()->comment('车牌号');
            $table->dateTime('start')->comment('开始时间');
            $table->dateTime('end')->comment('结束时间');
            $table->char('enterprise', 50)->nullable()->comment('单位名称');
            $table->tinyInteger('issue')->default(0)->comment('0人脸未下发1人脸已下发');
            $table->tinyInteger('status')->default(0)->comment('-1已拒绝0待访问1已访问');
            $table->tinyInteger('is_read')->default(0)->comment('0未读1已读');
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
        Schema::dropIfExists('appointments');
    }
}
