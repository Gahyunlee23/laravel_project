<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryHotelsTable extends Migration
{
	public function up()
	{
		Schema::create('category_hotels', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('upper_id')->comment('상위 모델 id');
            $table->foreignId('hotel_id')->nullable()->comment('호텔 명 OR 호텔id');
            $table->string('hotel_name', 30)->nullable()->comment('호텔 명 OR 호텔id');
            $table->integer('order')->nullable()->default(100)->comment('호텔 정렬 순');
            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('category_hotels');
	}
}
