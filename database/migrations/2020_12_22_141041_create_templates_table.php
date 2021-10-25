<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /* 'id', 'company', 'code', 'name', 'template', 'button', 'web_url', 'mobile_url',*/
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('company',50)->default('트래블메이커코리아')->comment('발신프로필');

            $table->string('code',20)->nullable()->comment('템플릿 코드');
            $table->string('name',20)->nullable()->comment('템플릿 명');
            $table->text('template')->comment('템플릿');
            $table->text('button')->nullable()->comment('템플릿 버튼');
            $table->text('web_url')->nullable()->comment('템플릿 웹 링크');
            $table->text('mobile_url')->nullable()->comment('템플릿 모바일 링크');

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
        Schema::dropIfExists('templates');
    }
}
