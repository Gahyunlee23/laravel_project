<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('period_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->nullable();
            $table->foreignId('scheduler_id')->nullable();
            $table->foreignId('room_type_id')->nullable()->comment('룸 Type ID');
            $table->foreignId('admin_id')->nullable()->comment('관리자 ID');
            /* 예]
            1일 : 1일 ~ 다음 일수 7일
            7일 : 7일 ~ 다음 일수 13일
            14일 : 14일 ~ 다음 일수 20일
            21일 : 21일 ~ 다음 일수 28일
            29일 : 29일 ~ 다음 없을경우 ~~~ 쭉
            */
            $table->integer('date')->nullable()->comment('일 수 ~');
            $table->integer('price')->nullable()->comment('해당 일수의 가격');
            //$table->string('',60)->nullable()->comment('');

            $table->text('memo')->nullable()->comment('메모');
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
        Schema::dropIfExists('period_prices');
    }
}
