<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypeImagesTable extends Migration
{
	public function up()
	{
		Schema::create('room_type_images', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('hotel_id')->nullable()->comment('연관 호텔 id');
			$table->foreignId('room_type_id')->nullable()->comment('연관 룸 타입 id');
			$table->foreignId('admin_id')->nullable()->comment('입력 관리자 id');
			$table->text('path')->nullable()->comment('이미지 Path');
			$table->string('name', 30)->nullable()->comment('이미지 명칭');
			$table->string('explanation', 30)->nullable()->comment('이미지 설명');

			$table->string('order', 11)->nullable()->comment('출력 순서');

            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('room_type_images');
	}
}
