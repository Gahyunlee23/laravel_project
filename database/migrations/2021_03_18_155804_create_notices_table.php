<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('hotel_id')->nullable();
            $table->foreignId('reservation_id')->nullable();
            $table->string('reservation_type',20)->nullable()->comment('투어, 입주');
            $table->string('reservation_status',20)->nullable()->comment('투어, 입주 상태');
            $table->text('content')->nullable()->comment('전송내용');
            $table->string('link',200)->nullable()->comment('링크 - 내 외');

            $table->dateTime('send_dt')->nullable()->comment('전송 dt');
            $table->dateTime('read_dt')->nullable()->comment('읽은 dt');
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
        Schema::dropIfExists('notices');
    }
}
