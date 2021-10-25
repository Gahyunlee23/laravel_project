<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelBenefitsTable extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_benefits', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');

            $table->foreignId('benefit_id')->nullable()->comment('베네핏 id');

            $table->string('name', 50)->nullable()->comment('');
            $table->string('explanation', 50)->nullable()->comment('');
            $table->string('period', 50)->nullable()->comment('null = 공통, only, 1주, 2주 등');
            //$table->dateTime('')->nullable()->comment('');

            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_benefits');
	}
}
