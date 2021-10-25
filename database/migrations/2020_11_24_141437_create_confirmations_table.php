<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->nullable()->comment('주문 id');
            $table->foreignId('payment_id')->nullable()->comment('결제 id');
            $table->foreignId('user_id')->nullable()->comment('user(관리자) id');

            $table->dateTime('start_dt')->nullable()->comment('입주 dt');
            $table->dateTime('end_dt')->nullable()->comment('퇴실 dt');
            $table->string('add_days',50)->nullable()->comment('추가 일수');

            $table->text('memo')->comment('메모');
            $table->string('status',11)->default(1)->nullable()->comment('0=취소, 1=기본');

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
        Schema::dropIfExists('confirmations');
    }
}
