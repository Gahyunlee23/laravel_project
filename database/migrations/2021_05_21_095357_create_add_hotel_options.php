<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotelOptions extends Migration
{
	public function up()
	{
		Schema::create('add_hotel_options', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');
            $table->text('facilities')->nullable()->comment('시설');
            $table->text('amenities')->nullable()->comment('도구');
            $table->text('benefit')->nullable()->comment('혜택');
            $table->text('benefit_only')->nullable()->comment('혜택 Only 표기');
            $table->text('benefit_type')->nullable()->comment('혜택 Type');

            $table->softDeletes();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotel_options');
	}
}
