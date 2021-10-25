<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertifiedKeysTable extends Migration
{
	public function up()
	{
		Schema::create('certified_keys', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->foreignId('user_id')->nullable()->comment('인증 User');
			$table->string('key', 20)->nullable()->comment('인증 키');
            $table->string('purpose', 10)->nullable()->comment('인증 목적');
            $table->string('type', 10)->nullable()->comment('인증 방법 - email, tel 등');
            $table->string('target', 50)->nullable()->comment('인증 하는 email, tel 등 User 의 정보');

            $table->dateTime('send_dt')->nullable()->comment('전송 dt');
            $table->dateTime('authentication_dt')->nullable()->comment('인증 dt');
            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('certified_keys');
	}
}
