<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qr', function (Blueprint $table) {
            $table->bigInteger('appointment_id')->comment('预约ID');
            $table->string('code')->unique()->comment('二维码内容');
            $table->string('img')->nullable()->comment('二维码图片 base64字符串');
            $table->tinyInteger('status')->default(-1)->comment('-1失效1正常');
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
        Schema::dropIfExists('qr');
    }
}
