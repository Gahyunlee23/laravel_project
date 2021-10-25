<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enter_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enter_id');
            $table->string('type',50)->default(null)->comment('룸 타입');
            $table->integer('supply_price_month')->default(null)->comment('한달살기 가격');
            $table->integer('supply_price_3_weeks')->default(null)->comment('3주 살기 가격');
            $table->integer('supply_price_2_weeks')->default(null)->comment('2주 살기 가격');
            $table->integer('supply_price_1_weeks')->default(null)->comment('1주 살기 가격');
            $table->integer('supply_price_short_day')->default(null)->comment('단기 살기 가격');
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
        Schema::dropIfExists('enter_rooms');
    }
}
