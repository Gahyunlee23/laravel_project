<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelItemsTable extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_items', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');
            $table->foreignId('room_type_id')->nullable()->comment('룸 타입 id');

            $table->integer('sale_price')->nullable()->comment('호텔 판매 가격');
            $table->integer('fee')->nullable()->comment('수수료');
            $table->integer('price')->nullable()->comment('최종 가격?');

            $table->softDeletes();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_items');
	}
}
