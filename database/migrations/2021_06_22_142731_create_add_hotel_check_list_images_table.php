<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelCheckListImagesTable extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_check_list_images', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');

            $table->string('image',100)->nullable()->comment('이미지 path');
            $table->string('order', 11)->nullable()->comment('출력 순');

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_check_list_images');
	}
}
