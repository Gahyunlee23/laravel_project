<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelReviewsTable extends Migration
{
    /**
     * Run the migrations.
     * 성명, 작성시기, hotel_id, 선택 룸 id, 리뷰 내용, 별점
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->default(null);
            $table->foreignId('hotel_room_type_id')->default(null);
            $table->string('name',20)->default(null)->comment('리뷰어 성명');
            $table->string('job',20)->default(null)->comment('리뷰어 직업');
            $table->string('star',10)->default(null)->comment('리뷰어 별점');
            $table->text('content');
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
        Schema::dropIfExists('hotel_reviews');
    }
}
