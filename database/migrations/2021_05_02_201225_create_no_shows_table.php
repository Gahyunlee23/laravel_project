<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoShowsTable extends Migration
{
	public function up()
	{
		Schema::create('no_shows', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('reservation_id')->nullable();
            $table->foreignId('confirmation_id')->nullable();
            $table->foreignId('hotel_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('hotel_manager_id')->nullable();

            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('no_shows');
	}
}
