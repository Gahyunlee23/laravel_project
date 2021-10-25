<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationCancelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_cancels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('admin_id')->nullable();
            $table->string('process',20)->nullable()->comment('진행 상태');
            $table->text('memo')->nullable()->comment('전송내용');

            $table->dateTime('send_dt')->nullable()->comment('신청 dt');
            $table->dateTime('process_dt')->nullable()->comment('처리 시간 dt');
            $table->softDeletes();
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
        Schema::dropIfExists('reservation_cancels');
    }
}
