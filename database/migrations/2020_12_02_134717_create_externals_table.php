<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('externals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->nullable()->comment('호텔 id');
            $table->foreignId('reservation_id')->nullable()->comment('주문 id');
            $table->string('key',100)->nullable()->comment('랜덤영어 50자 = 해당 컬럼 접근 키 일치해야 접근가능');
            $table->string('type',20)->nullable()->comment('무슨 허용 사항인지 저장 ex] 입실확정 처리, 투어 확정처리 등');
            $table->text('memo')->nullable()->comment('설명 = 처리 내용 저장용');
            $table->char('status',10)->nullable()->comment('처리에 대한 status');
            $table->timestamp('access_at')->nullable()->comment('접근 가능 ~ dt');
            $table->timestamp('access_end_at')->nullable()->comment('이후 접근 불가 dt');
            $table->timestamp('enter_at')->nullable()->comment('외부 접근 > 처리 dt');
            $table->timestamps();
        });
    }
    /*
    $table->foreignId('hotel_id')->nullable()->comment('호텔 id');
    $table->string('',50)->nullable()->comment('');
    $table->dateTime('_dt')->nullable()->comment('dt');
    $table->timestamp('_at')->nullable()->comment('at');
    $table->text('memo')->nullable()->comment('설명');
    $table->char('status',10)->nullable()->comment('처리에 대한 status');
     * */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('externals');
    }
}
