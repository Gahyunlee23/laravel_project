<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuratorInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curator_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curator_id');
            $table->text('explanation1')->default(null)->comment('큐레이터 개별 설명1');
            $table->text('explanation2')->default(null)->comment('큐레이터 개별 설명2');
            $table->text('explanation3')->default(null)->comment('큐레이터 개별 설명3');
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
        Schema::dropIfExists('curator_informations');
    }
}
