<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTermIdToHotelReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_reservations', function (Blueprint $table) {
            $table->foreignId('term_id')->after('curator_id')->nullable()->comment('신청 기간 id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_reservations', function (Blueprint $table) {
            //
        });
    }
}
