<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->string('title', 30)->nullable()->comment('Product 메인 상세');
            $table->string('sub_title', 30)->nullable()->comment('Product 서브 상세');
            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('products');
	}
}
