<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectSearchesTable extends Migration
{
	public function up()
	{
		Schema::create('collect_searches', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->string('search')->nullable()->comment('검색 워딩');
            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('collect_searches');
	}
}
