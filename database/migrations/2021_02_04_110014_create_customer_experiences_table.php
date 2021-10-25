<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->comment('주문정보');
            $table->char('gender','1')->nullable()->comment('성별 0=남,1=여');

            $table->string('manager',10)->default(null)->comment('담당자');
            $table->string('calculate_manager',10)->default(null)->comment('정산 담당자');
            $table->string('inquiry_channel',50)->default(null)->comment('문의 채널');
            $table->string('inflow_path',50)->default(null)->comment('유입 경로');
            $table->string('payment_method',50)->default(null)->comment('결제 수단');
            $table->string('refund_method',50)->default(null)->comment('환불 수단');

            $table->text('progress_status')->nullable()->comment('진행현황');
            $table->text('move_in_progress')->nullable()->comment('입주 처리 메모');
            $table->text('not_purchased_reason')->nullable()->comment('미구매 사유');
            $table->text('refund_reason')->nullable()->comment('환불 사유');
            $table->text('memo')->nullable()->comment('이외 내용 작성용');

            $table->integer('supply_price')->default(null)->comment('공급가');
            $table->integer('profit')->default(null)->comment('순이익 = 매출 총이익');
            $table->integer('refund_price')->default(null)->comment('순이익 = 매출 총이익');
            $table->integer('calculate_price')->default(null)->comment('호텔 정산 금액');
            $table->integer('calculate_refund_price')->default(null)->comment('호텔 정산 환불 금액');

            $table->timestamp('inquiry_at')->nullable()->comment('문의 시간');
            $table->timestamp('refund_at')->nullable()->comment('환불 처리 시간');
            $table->timestamp('calculate_at')->nullable()->comment('정산 시간');
            $table->timestamp('first_at')->nullable()->comment('최초 작성 시간');
            $table->timestamps();
        });
    }
/*
$table->foreignId('reservation_id')->comment('주문정보');
$table->text('progress_status')->nullable()->comment('진행현황');
$table->string('inquiry_channel',50)->default(null)->comment('문의 채널');
$table->integer('')->default(null)->comment('');
$table->char('gender','1')->nullable()->comment('성별 0=남,1=여');
$table->timestamp('inquiry_at')->nullable()->comment('문의 시간');
 * */
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_experiences');
    }
}
