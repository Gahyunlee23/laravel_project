<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedulers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->nullable();
            $table->foreignId('period_price_id')->nullable();
            $table->foreignId('admin_id')->nullable();

            $table->dateTime('start_dt')->nullable()->comment('출력 시작 dt');
            $table->dateTime('end_dt')->nullable()->comment('종료 dt');

            $table->softDeletes();
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
        Schema::dropIfExists('schedulers');
    }
}
