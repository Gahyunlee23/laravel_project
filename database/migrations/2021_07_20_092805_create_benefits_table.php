<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefitsTable extends Migration
{
	public function up()
	{
		Schema::create('benefits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('option_id')->nullable()->comment('연관 options ID');
            $table->foreignId('hotel_id')->nullable()->comment('연관 호텔 ID');
            $table->foreignId('admin_id')->nullable()->comment('작성 관리자 ID');

            $table->string('name', 30)->nullable()->comment('혜택 이름');
            $table->string('explanation', 50)->nullable()->comment('혜택 설명');
            $table->string('order', 11)->nullable()->comment('정렬');

            $table->softDeletes();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('benefits');
	}
}
