<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelCheckPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_check_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id');
            $table->string('title1',50)->default(null)->comment('체크포인트 1 title');
            $table->text('explanation1')->default(null)->comment('체크포인트 1 설명');
            $table->string('title2',50)->default(null)->comment('체크포인트 2 title');
            $table->text('explanation2')->default(null)->comment('체크포인트 2 설명');
            $table->string('title3',50)->default(null)->comment('체크포인트 3 title');
            $table->text('explanation3')->default(null)->comment('체크포인트 3 설명');
            $table->char('disable',1)->default('N')->comment('비활성화');

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
        Schema::dropIfExists('hotel_check_points');
    }
}
