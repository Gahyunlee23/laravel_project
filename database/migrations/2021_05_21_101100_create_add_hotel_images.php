<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelImages extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_images', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');

            $table->string('type',10)->nullable()->comment('종류');
            $table->string('title',50)->nullable()->comment('사진 [제목, 타이틀]');

            $table->string('image', 200)->nullable()->comment('이미지');

            $table->text('explanation')->nullable()->comment('설명 180자 이하');
            $table->text('sub_explanation')->nullable()->comment('서브 설명 180자 이하');

            $table->char('order', 5)->nullable()->comment('출력 순서');

            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_images');
	}
}
