<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enter_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enter_id');
            $table->text('amenities')->default(null)->comment('도구');
            $table->text('facilities')->default(null)->comment('시설');
            $table->text('benefit')->default(null)->comment('혜택');
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
        Schema::dropIfExists('enter_options');
    }
}
