<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelLogsTable extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_logs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->foreignId('add_hotel_id')->comment('입점 신청 호텔 ID');
			$table->foreignId('hotel_manager_id')->nullable()->comment('처리 호텔 매니저 ID');
			$table->foreignId('admin_id')->nullable()->comment('처리 관리자 ID');
			$table->string('old_status', 30)->nullable()->comment('이전 상태');
			$table->string('status', 30)->nullable()->comment('현 상태');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_logs');
	}
}
