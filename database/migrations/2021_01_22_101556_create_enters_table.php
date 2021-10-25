<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enters', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name',50)->default(null)->comment('호텔 명');
            $table->string('hotel_address',100)->default(null)->comment('호텔 주소');
            $table->string('hotel_web_address',200)->default(null)->comment('호텔 웹 사이트');

            $table->string('manager_name',20)->default(null)->comment('담당자 명');
            $table->string('manager_rank',20)->default(null)->comment('담당자 직급');
            $table->string('manager_email',100)->default(null)->comment('담당자 이메일');
            $table->string('manager_hp',20)->default(null)->comment('담당자 연락처');

            $table->char('status',1)->default('0')->comment('처리 상태');
            $table->char('progress',2)->default('0')->comment('진행 상태');
            $table->text('memo')->default(null)->comment('메모');
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
        Schema::dropIfExists('Enters');
    }
}
