<?php

use App\Http\Controllers\SchedulesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
//Route::post('/at', 'AlertController@alertSend')->name('alertSend');


/* 관리자 페이지 각 호텔 스케줄러 GET API */
Route::post('/hotel/schedules/{hotel?}/{activeStart?}/{activeEnd?}', [SchedulesController::class, 'lists'])->name('api.hotel.schedules');
Route::post('/payment/in/{reservation?}', [SchedulesController::class, 'test'])->name('api.payment.in');
