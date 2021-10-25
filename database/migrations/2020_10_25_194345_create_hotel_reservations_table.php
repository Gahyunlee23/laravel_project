<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id');
            $table->string('order_id',6)->comment('구매 ID 랜덤 6자');

            $table->string('type',10)->comment('호텔투어=tour, 한달살기=month, 구독=subscribe');
            $table->foreignId('room_id')->comment('한달살기 일 경우 룸 id');
            $table->string('order_name',10)->default(null)->comment('구매자 명');
            $table->string('order_hp',20)->default(null)->comment('구매자 연락처');
            $table->string('order_email',50)->default(null)->comment('구매자 이메일');
            $table->char('order_privacy',1)->default('Y')->comment('Y,N 구매자 개인정보 활용 동의');
            $table->char('order_marketing',1)->default('N')->comment('Y,N 마케팅 동의');

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
        Schema::dropIfExists('hotel_reservations');
    }
}
