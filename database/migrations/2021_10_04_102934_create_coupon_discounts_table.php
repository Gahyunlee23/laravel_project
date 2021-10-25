<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponDiscountsTable extends Migration
{
	public function up()
	{
		Schema::create('coupon_discounts', function (Blueprint $table) {
			$table->bigIncrements('id');

			//

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('coupon_discounts');
	}
}
