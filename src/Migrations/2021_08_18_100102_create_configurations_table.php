<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->char('name', 50)->nullable()->comment('配置名称');
            $table->char('mark', 20)->unique()->comment('配置标志');
            $table->bigInteger('company_id')->nullable()->comment('公司ID');
            $table->json('options')->comment('配置选项');
            $table->tinyInteger('status')->default(1)->comment('0禁用1正常');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
