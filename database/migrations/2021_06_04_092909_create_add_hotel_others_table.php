<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelOthersTable extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_others', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');

            $table->string('name', 20)->nullable()->comment('호텔 매니저 성명');
            $table->string('phone_number', 20)->nullable()->comment('연락처 hot line');
            $table->string('department_name', 20)->nullable()->comment('부서명');
            $table->string('department_position', 20)->nullable()->comment('부서 직급');

            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_others');
	}
}
