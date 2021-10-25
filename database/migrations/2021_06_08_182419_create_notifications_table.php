<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
	public function up()
	{
		Schema::create('notifications', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->foreignId('admin_id')->nullable()->comment('전송 TM 관리자 ID');
            $table->foreignId('user_id')->nullable()->comment('전송 받는 User id');
            $table->string('remember_token', 100)->nullable()->comment('전송 받는 리멤버 토큰 키 - 휴대전화');

            $table->string('type', 10)->nullable()->comment('전송 디자인 타입');
            $table->string('timer', 10)->nullable()->comment('전송 후 표기 시간 기본 2초');
            $table->text('content')->nullable()->comment('알림 전송 내용');

            $table->string('resend', 5)->nullable()->comment('재전송 횟수(자동)');

            $table->dateTime('start_dt')->nullable()->comment('전송 시작 시간');
            $table->dateTime('end_dt')->nullable()->comment('전송 종료 시간');

            $table->dateTime('send_dt')->nullable()->comment('전송 처리 시간');
            $table->dateTime('read_dt')->nullable()->comment('읽은 처리 시간 - 개별적 읽음 처리');
            $table->dateTime('forwarded_dt')->nullable()->comment('전송 받은 시간 - 유저 에게 알림 출력 처리');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('notifications');
	}
}
