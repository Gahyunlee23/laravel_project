<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelNeedToModifiesTable extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_need_to_modifies', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->foreignId('admin_id')->nullable()->comment('TM 관리자 ID');
            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');

            $table->string('status' ,10)->nullable()->comment('상태');
            $table->string('target' ,20)->nullable()->comment('input, page 수정 필요 타겟');
            $table->text('content')->nullable()->comment('수정 필요 사항');

            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_need_to_modifies');
	}
}
