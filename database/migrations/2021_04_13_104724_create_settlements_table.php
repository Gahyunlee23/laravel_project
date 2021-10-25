<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->nullable();

            $table->integer('price')->nullable()->comment('이전 판매금');
            $table->integer('calculate')->nullable()->comment('정산금');
            $table->text('memo')->nullable()->comment('메모');
            $table->dateTime('save_dt')->nullable()->comment('정산 저장 시간 dt');
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
        Schema::dropIfExists('settlements');
    }
}
