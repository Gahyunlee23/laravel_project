<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id');
            $table->foreignId('user_id')->default(1)->comment('작성자 user id');
            $table->string('name',50)->comment('룸 명');
            $table->string('price',10)->comment('원가격');
            $table->string('sale_price',10)->comment('판매가');
            $table->string('discount_rate',10)->comment('할인률');
            $table->string('refund_amount',10)->comment('취소환불금액');
            $table->text('explanation')->comment('설명');
            $table->text('sub_explanation')->comment('서브 설명');
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
        Schema::dropIfExists('hotel_rooms');
    }
}
