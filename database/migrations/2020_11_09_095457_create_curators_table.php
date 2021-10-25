<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curators', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',30)->unique()->comment('큐레이터 id');
            $table->string('user_page',30)->unique()->comment('큐레이터 전용 page 명');
            $table->string('user_pass',30)->comment('큐레이터 password');
            $table->string('name',10)->default(null)->comment('큐레이터 이름');
            $table->string('tel',20)->default(null)->comment('큐레이터 연락처');
            $table->string('email',50)->default(null)->comment('큐레이터 이메일');
            $table->text('explanation')->default(null)->comment('큐레이터 설명');
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
        Schema::dropIfExists('curators');
    }
}
