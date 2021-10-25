<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id');
            $table->foreignId('user_id')->comment('작성자 user id');
            $table->text('faq');
            $table->text('faq_answer');
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
        Schema::dropIfExists('hotel_faqs');
    }
}
