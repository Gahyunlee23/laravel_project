<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->comment('user(관리자) id');

            $table->text('memo')->comment('스케쥴 메모');
            $table->text('change_memo')->comment('변경 점 자동 저장 / 스케쥴');
            $table->dateTime('send_start_dt')->nullable()->comment('년월일 시:분:초 / 전송 일정');
            $table->dateTime('send_between_dt')->nullable()->comment('~ 년월일 시:분:초 / 전송 일정 끝');

            $table->char('activation',1)->default(1)->comment('0=비활성, 1=활성 / 비활성화 시 미전송 / 활성화');
            $table->char('send',1)->default(0)->nullable()->comment('0=미전송, 1=전송 / 사용체크');
            $table->char('cancel',1)->default(0)->nullable()->comment('0=진행, 1=취소 / 전송 후 취소 불가 / 취소 처리');
            $table->dateTime('activation_dt')->nullable()->comment('활성화 변경 처리 dt');
            $table->dateTime('send_dt')->nullable()->comment('전송 처리 dt');
            $table->dateTime('cancel_dt')->nullable()->comment('취소 처리 dt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
