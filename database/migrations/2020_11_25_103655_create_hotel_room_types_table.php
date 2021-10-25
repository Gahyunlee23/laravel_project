<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotelRoomType', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->nullable()->comment('호텔 id');
            $table->foreignId('user_id')->nullable()->comment('user(관리자) id');
            $table->string('type_name',50)->nullable()->comment('룸 배드 명칭');
            $table->string('type_main_explanation',50)->nullable()->comment('룸 배드 개수');
            $table->string('type_sub_explanation',50)->nullable()->comment('룸 타입 하단 추가 설명');
            $table->string('type_order',10)->nullable()->comment('룸 타입 정렬순');
            $table->string('type_visible',10)->nullable()->comment('룸 타입 보일지');
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
        Schema::dropIfExists('hotelRoomType');
    }
}
