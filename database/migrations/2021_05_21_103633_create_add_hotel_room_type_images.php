<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelRoomTypeImages extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_room_type_images', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->foreignId('add_hotel_room_type_id')->nullable()->comment('Room Type ID');
            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');

            $table->string('name', 20)->nullable()->comment('명칭');
            $table->string('main_explanation', 30)->nullable()->comment('이미지 상세 설명');
            $table->string('sub_explanation', 30)->nullable()->comment('이미지 서브 설명');

            $table->string('image', 200)->nullable()->comment('이미지 링크');

            $table->char('order', 5)->nullable()->comment('출력 순서');

            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_room_type_images');
	}
}
