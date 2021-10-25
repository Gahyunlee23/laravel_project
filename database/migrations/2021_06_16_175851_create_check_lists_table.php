<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckListsTable extends Migration
{
	public function up()
	{
		Schema::create('check_lists', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('admin_id')->nullable()->comment('작성 관리자');
            $table->foreignId('group_id')->nullable()->comment('그룹 셋');

			$table->text('question')->nullable()->comment('실제 질문 내용');

			$table->json('request')->nullable()->comment('Json input form');
			$table->json('response')->nullable()->comment('Json Y/N 의 반응 질문 또는 입력값? 개수 >= 등 처리');

            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('check_lists');
	}
}
