<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelPeriodsTable extends Migration
{
    public function up()
    {
        Schema::create('add_hotel_periods', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');
            $table->foreignId('room_type_id')->nullable()->comment('룸 타입 id');

            $table->string('name', 30)->nullable()->comment('기간 명칭');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('add_hotel_periods');
    }
}
