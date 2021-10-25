<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertTalkListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alert_talk_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->nullable()->comment('템플릿 id');
            $table->foreignId('reservation_id')->nullable()->comment('주문 id');
            $table->foreignId('payment_id')->nullable()->comment('결제 id');
            $table->foreignId('confirmation_id')->nullable()->comment('확정 id');
            $table->foreignId('hotel_id')->nullable()->comment('호텔 id');
            $table->foreignId('room_id')->nullable()->comment('호텔 룸 id');
            $table->string('situation',50)->nullable()->comment('전송 상황');
            $table->string('result',50)->nullable()->comment('전송 처리');
            $table->timestamp('send_at')->nullable()->comment('전송 시간');
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
        Schema::dropIfExists('alert_talk_lists');
    }
}
