<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelCheckListsTable extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_check_lists', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');
            $table->foreignId('check_group_id')->nullable()->comment('체크 그룹 ID');
            $table->foreignId('check_list_id')->nullable()->comment('체크 list ID');

            $table->text('answer')->nullable()->comment('답변 : Y, N / String / Number / Date 등');
            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_check_lists');
	}
}
