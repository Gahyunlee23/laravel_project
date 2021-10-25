<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddHotels extends Migration
{
	public function up()
	{
		Schema::create('add_hotels', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->foreignId('hotel_manager_id')->nullable()->comment('호텔 매니저 User id');

            $table->string('enter_status', 10)->nullable()->default('진행 중')->comment('삭제, 진행 중, 중간 저장, 저장 완료, 심사 대기, 심사 중, 협의 중, 미 승인, 승인 완료, 오픈 준비, 오픈완료');

            $table->string('name',50)->nullable()->comment('호텔 명칭');
            $table->string('name_en',100)->nullable()->comment('호텔 영명칭');
            $table->string('subway_station',30)->nullable()->comment('근처 지하철 역');
            $table->string('area',200)->nullable()->comment('호텔 주소');
            $table->string('lat',20)->nullable()->comment('위도');
            $table->string('lng',20)->nullable()->comment('경도');
//            $table->text('explanation')->nullable()->comment('입주 설명 부분');
//            $table->text('sub_explanation')->nullable()->comment('투어 설명 부분');
            $table->char('star', 4)->nullable()->comment('호텔 성급');
            $table->string('email', 100)->nullable()->comment('입주 담당자 이메일');
            $table->string('tour_email', 100)->nullable()->comment('투어 담당자 이메일');
            $table->string('admin_email', 100)->nullable()->default('zuiderzee@naver.com')->comment('TM 관리자 메일');
            $table->time('tour_start')->nullable()->comment('투어 시작 시간');
            $table->time('tour_end')->nullable()->comment('투어 종료 시간');
            $table->time('checkin_time')->nullable()->comment('입주 시간');
            $table->time('checkout_time')->nullable()->comment('퇴실 시간');
            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('add_hotels');
	}
}
