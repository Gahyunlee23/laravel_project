<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelRoomTypes extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_room_types', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');

            $table->string('name', 50)->nullable()->comment('룸 배드 명칭');
            $table->string('main_explanation', 50)->nullable()->comment('룸 배드 개수');
            $table->string('sub_explanation', 50)->nullable()->comment('룸 타입 하단 추가 설명');

            $table->string('upgrade', 10)->nullable()->comment('업그레이드 용 0 1');
            $table->string('sold_out', 10)->nullable()->comment('판매 완료=1, 판매중=0');
            $table->integer('sale_possibility_count')->nullable()->comment('판매 가능 총 개수');

            $table->char('order', 5)->nullable()->comment('출력 순서');

            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_room_types');
	}
}
