<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * .
    3.설정 기간 ~ 끝 기간
    4.블록 on off
    5.최대 개수 기본:99999개
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->nullable()->comment('주문 id');
            $table->foreignId('sale_room_id')->nullable()->comment('룸 할인 id');
            $table->foreignId('user_id')->nullable()->comment('user(관리자) id');

            $table->char('block',11)->default('0')->nullable()->comment('잠금=1, 미잠금=0');
            $table->string('type',11)->default('0')->nullable()->comment('type 0=tour,1=hotel');

            $table->string('reservation_count',11)->default('9999999')->nullable()->comment('주문 가능 개수');
            $table->string('sale_count',11)->default('9999999')->nullable()->comment('판매 가능 개수');

            $table->text('memo')->comment('메모');

            $table->dateTime('start_dt')->nullable()->comment('입주 dt');
            $table->dateTime('end_dt')->nullable()->comment('퇴실 dt');
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
        Schema::dropIfExists('terms');
    }
}
