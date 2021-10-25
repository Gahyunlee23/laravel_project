<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelToursTable extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_tours', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');

            $table->string('day', 10)->nullable()->comment('요일');
            $table->time('start')->nullable()->comment('시작 시간');
            $table->time('end')->nullable()->comment('끝 시간');

           $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_tours');
	}
}
