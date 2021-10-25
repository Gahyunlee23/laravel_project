<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIcons extends Migration
{
    public function up()
    {
        Schema::create('icons', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name', '15')->nullable()->comment('해당 SVG name : 침대, 식수, 수건 등');
            $table->string('explanation', '50')->nullable()->comment('해당 SVG 설명');
            $table->string('type', '10')->nullable()->comment('사용 범위 예: benefit, amenities, facilities, all-전체, logo, form 등');
            $table->text('content')->nullable()->comment('실제 SVG 데이터');
            $table->string('url',150)->nullable()->comment('S3 SVG 링크');
            $table->smallInteger('order')->nullable()->comment('정렬 순서');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('icons');
    }
}
