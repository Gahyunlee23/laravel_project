<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
	public function up()
	{
		Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('hotel_id')->nullable()->comment('연관 호텔 ID');
            $table->foreignId('period_price_id')->nullable()->comment('연관 기간 가격 ID');
            $table->foreignId('admin_id')->nullable()->comment('작성 관리자 ID');

            $table->text('memo')->nullable()->comment('메모');

            $table->char('disabled', 1)->nullable()->default('0')->comment('비활성화');

            $table->dateTime('start_dt')->nullable()->comment('시작 시간');
            $table->dateTime('end_dt')->nullable()->comment('종료 시간');

            $table->softDeletes();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('options');
	}
}
