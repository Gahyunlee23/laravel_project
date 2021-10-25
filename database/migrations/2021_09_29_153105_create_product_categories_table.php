<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
	public function up()
	{
		Schema::create('product_categories', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->string('type', 10)->nullable()->comment('출력 위치 세팅');
            $table->string('hotels', 30)->nullable()->comment('호텔 명으로 일반, 큐레이터 호텔 서칭 출력');
            $table->integer('order')->nullable()->default(100)->comment('출력 순서');
            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('product_categories');
	}
}
