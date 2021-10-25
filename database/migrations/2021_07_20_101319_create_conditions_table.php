<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConditionsTable extends Migration
{
	public function up()
	{
		Schema::create('conditions', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('option_id')->nullable()->comment('연관 options ID');
            $table->foreignId('hotel_id')->nullable()->comment('연관 호텔 ID');
            $table->foreignId('admin_id')->nullable()->comment('작성 관리자 ID');

            $table->integer('limits')->nullable()->comment('선착 인원 수');

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
		Schema::dropIfExists('conditions');
	}
}
