<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelUsePrecautionsTable extends Migration
{
	public function up()
	{
		Schema::create('hotel_use_precautions', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('hotel_id')->nullable()->comment('연결 호텔 정보');
            $table->string('type', 10)->nullable()->comment('주의 사항 Type');
            $table->text('content')->nullable()->comment('사항 내용');
            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('hotel_use_precautions');
	}
}
