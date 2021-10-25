<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('hotel_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id');
            $table->foreignId('user_id')->comment('작성자 user id');
            $table->string('type',10)->comment('옵션 타입 / main, sub[1~], review 등');
            $table->string('title',50)->comment('사진 [제목, 타이틀]');
            $table->text('images')->comment('이미지[]');
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
        Schema::dropIfExists('hotel_images');
    }
}
