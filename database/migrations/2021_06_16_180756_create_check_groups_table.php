<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckGroupsTable extends Migration
{
	public function up()
	{
		Schema::create('check_groups', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->foreignId('admin_id')->nullable()->comment('작성 관리자');
            $table->string('order', 11)->nullable()->comment('출력 순');
			$table->string('title', 30)->nullable()->comment('질문 타이틀');
            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('check_groups');
	}
}
