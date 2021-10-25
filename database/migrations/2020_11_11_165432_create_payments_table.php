<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->comment('주문 ID');
            $table->foreignId('order_id')->comment('결제 주문 리턴: OID [년월일시분초-랜덤숫자1000~9999]');
            $table->string('card_type',5)->nullable()->comment('카드 결제 방식 02=앱카드, 01=간편결제');
            $table->string('pay_type',11)->nullable()->comment('결제 방식');
            $table->string('pay_url',150)->nullable()->comment('결제 처리 url');
            $table->string('email',50)->nullable()->comment('구매자 이메일');
            $table->string('name',11)->nullable()->comment('구매자 명');
            $table->string('hp',20)->nullable()->comment('구매자 연락처');
            $table->char('goods_tax',1)->nullable()->comment('택스 방식');
            $table->string('goods_name',100)->nullable()->comment('상품명');
            $table->string('goods_option',100)->nullable()->comment('상품 옵션');
            $table->string('total_price',11)->nullable()->comment('총 결제 가격');
            $table->string('status',11)->nullable()->comment('결제 상태');
            $table->string('message',50)->nullable()->comment('상태 메세지');
            $table->string('result_message',20)->nullable()->comment('결과 메세지');

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
        Schema::dropIfExists('payments');
    }
}
