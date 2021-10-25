<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelCancellationRefundPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_cancellation_refund_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id');
            $table->string('in_use_hotel_fault',30)->default(null)->comment('호텔 귀책 이용 중 취소');
            $table->string('in_use_customer_fault',30)->default(null)->comment('고객 귀책 이용 중 취소');
            $table->string('day',30)->default(null)->comment('당일 (24시 내) 취소');
            $table->string('days_1_6',30)->default(null)->comment('1~6일 취소 취소');
            $table->string('days_7_10',30)->default(null)->comment('7~10일 취소 취소');
            $table->string('days_11_20',30)->default(null)->comment('11~20일 취소 취소');
            $table->string('days_21_30',30)->default(null)->comment('21~30일 취소 취소');
            $table->string('weekday_cost',30)->default(null)->comment('평일 원가');
            $table->string('weekend_cost',30)->default(null)->comment('주말 원가');

            $table->char('visible',1)->default('1')->comment('1=활성화');

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
        Schema::dropIfExists('hotel_cancellation_refund_policies');
    }
}
