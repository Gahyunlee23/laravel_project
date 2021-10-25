<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuratorBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curator_banner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curator_id')->nullable();
            $table->foreignId('hotel_id')->nullable();

            $table->string('tab',30)->nullable()->comment('모아보기 시 탭');
            $table->string('depth',30)->nullable()->comment('모아보기 시 뎁스');

            $table->string('type',20)->nullable()->comment('main curator banner');
            $table->string('route',50)->nullable()->comment('hotels.collect OR hotel.view');

            $table->string('title',60)->nullable()->comment('');
            $table->text('explanation')->nullable()->comment('하단 설명');

            $table->text('event')->nullable()->comment('Event Coupon 워딩');
            $table->text('images')->nullable()->comment('이미지 / 다수도 가능 하게 세팅');

            $table->integer('order')->default(100)->comment('정렬 순서');

            $table->text('memo')->nullable()->comment('메모');
            $table->dateTime('start_dt')->nullable()->comment('출력 시작 dt');
            $table->dateTime('end_dt')->nullable()->comment('종료 dt');
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
        Schema::dropIfExists('curator_banner');
    }
}
