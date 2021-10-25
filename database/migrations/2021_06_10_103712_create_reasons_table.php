<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReasonsTable extends Migration
{
	public function up()
	{
		Schema::create('reasons', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('admin_id')->nullable()->comment('Tm 관리자 ID');
            $table->foreignId('add_hotel_id')->nullable()->comment('입점 신청 호텔 ID');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User ID');

            $table->string('type',10)->nullable()->comment('종류 : 입점신청, 이외 계약, 이벤트 등');

            $table->text('explanation')->nullable()->comment('사유 180자 이하');
            $table->text('sub_explanation')->nullable()->comment('사유 설명 180자 이하');

            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('reasons');
	}
}
