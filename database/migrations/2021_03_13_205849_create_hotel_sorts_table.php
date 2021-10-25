<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelSortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_sorts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->nullable();
            $table->string('type',20)->nullable()->comment('정렬 종료');
            $table->string('order',20)->nullable()->comment('정렬 순서');
            $table->dateTime('start_dt')->nullable()->comment('시작 dt');
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
        Schema::dropIfExists('hotel_sorts');
    }
}
