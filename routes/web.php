<?php

use App\AlertTalk;
use App\AlertTalkList;
use App\Confirmation;
use App\Curator;
use App\Exports\HotelReservationsExport;
use App\External;
use App\Formatter;
use App\Hotel;
use App\HotelOption;
use App\HotelReservation;
use App\HotelRoom;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\MailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Hotels\CopyController;
use App\Http\Controllers\Hotels\EnterController;
use App\Http\Controllers\Hotels\HotelEntryController;
use App\Http\Controllers\Hotels\HotelManagerController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\InicisController;
use App\Payment;
use App\Template;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Auth::routes();

/* AWS ELB 헬스 체크 세션 처리 제외 */
Route::get('/health-check', [HomeController::class, 'healthCheck'])->middleware('aws.health-check');

Route::POST('/hotel/detail', 'Hotels\HotelController@detail')->name('hotel.detail');
Route::POST('/hotel/order', 'Hotels\HotelController@order')->name('hotel.order');
Route::POST('/hotel/orderCompleted', 'Hotels\HotelController@orderCompleted')->name('hotel.order.completed');

/* 개별 주문 신청 접근 페이지*/
Route::POST('/hotel/reservation/order/{hotel}', 'Hotels\HotelController@reservationOrder')->name('hotel.reservation.order');
Route::GET('/hotel/reservation/option/{hotel}/{reservation}', 'Hotels\HotelController@reservationOption')->name('hotel.reservation.option');

/* 1분에 10번 접근 가능 */
Route::middleware('throttle:10,1')->group(function () {
    Route::GET('/hotels/collect/{tab?}/{depth?}/{curator_page?}', 'Hotels\HotelController@hotelsCollect')->name('hotels.collect');
});

/* 큐레이터 접근 키 */
if (!Str::contains(Request::url(), ['admin','my-page','hotel-entry'])) {
    Route::get('/{curator_page?}', 'HomeController@index')->name('/');

    /* 접근 실패시 기본 홈 */
    Route::fallback(function () {
        return redirect()->route('/');
    });
}
Route::get('/hotel/{hotel}/{curator_page?}', 'HomeController@view')->name('hotel.view');
Route::get('/hotels/{hotel}/{curator_page?}', 'HomeController@hotelNamingView')->name('hotel.naming.view');

/* 호텔 상세 보기 + 큐레이터 */

/*---------------------------------------------- 관리자 ------------------------------------------*/
//지정된 룰만 접근 가능한 처리
Route::prefix('admin')->middleware(['role:super-admin|admin', 'auth'])->group(function () {
    /*Route::get('/schedule', 'Schedules\ScheduleController@index')->name('schedule');*/
    Route::get('/dash-board', 'Admins\AdminController@adminMain')->name('admin');
    /* 배너 관리자 페이지 */
    Route::get('/banner/{type?}', [AdminController::class, 'adminBanner'])->name('admin.banner');
    Route::post('/banner/edit/{banner?}', [AdminController::class, 'adminBannerEdit'])->name('admin.banner.edit');

    /*비밀번호 변경*/
    Route::POST('/password/update/{user?}', 'Admins\AdminController@adminPasswordUpdate')->name('admin.password.update');
    /* 입점 호텔 리스트*/
    Route::get('/enter/hotels/list', 'Admins\AdminController@enterHotelsList')->name('enter.hotels.list');
    /* 입점 호텔 리스트*/
    Route::get('/recommendation/hotels/list', 'Admins\AdminController@recommendationHotelsList')->name('hotels.recommendation');
    /* 정보 인설트 용 */
    Route::get('/import', 'Admins\AdminController@import')->name('import');
    /*호텔관리*/
    Route::Resource('hotel', 'Hotels\HotelController');
    Route::get('/hotel', 'Hotels\HotelController@index')->name('hotel.index');
    Route::get('/hotel/curator/list', 'Hotels\HotelController@hotelCurator')->name('hotel.curator');
    Route::get('/hotel/{hotel}/edit', 'Hotels\HotelController@edit')->name('hotel.edit');
    Route::DELETE('/hotel/{hotel}', 'Hotels\HotelController@destroy')->name('hotel.destroy');
    Route::POST('/hotel/{hotel}/close', 'Hotels\HotelController@close')->name('hotel.close');
    Route::POST('/hotel/{hotel}/open', 'Hotels\HotelController@open')->name('hotel.open');
    Route::POST('/hotel/{hotel}/grade/append', 'Hotels\HotelController@gradeAppend')->name('hotel.grade.append');
    Route::POST('/hotel/{hotel}/grade/delete', 'Hotels\HotelController@gradeDelete')->name('hotel.grade.delete');
    Route::POST('/hotel/room/option/{hotel}', 'Hotels\HotelController@roomOption')->name('hotel.room.option');
    /*호텔 정렬 페이지*/

    /*예약관리*/
    Route::get('/hotel/lists/reservations', 'Hotels\HotelController@reservations')->name('hotel.reservations');
    Route::POST('/hotel/{reservation}/{type}/reservation', 'Hotels\HotelController@reservationOrderStatus')->name('hotel.reservation.order-status');

    /*관리자 수동 회원 투어 결제완료 처리 +알림톡 */
    Route::POST('/hotel/reservation/payments', 'Payple\PaymentController@reservationCompleted')->name('hotel.reservation.payments');

    /*관리자 수동 / 입주 확정 처리 +알림톡 */
    Route::POST('/confirmation/livinginhotel', 'Confirmation\ConfirmationController@livinginhotel')->name('confirmation.livinginhotel');

    /* 큐레이터 */
    //Route::get('/curator','Curators\CuratorController@index')->name('curator.index');
    Route::Resource('curator', 'Curators\CuratorController');
    Route::POST('/curator/build/{curator}', 'Curators\CuratorController@build')->name('curator.build');

    /* DEV Start */
    Route::get('/dev', [HomeController::class,'dev'])->name('admin.dev.index');
    /* 호텔 상세 보기 + 큐레이터 */
    Route::get('/dev/hotel/{hotel}/{curator_page?}', 'HomeController@devView')->name('admin.dev.hotel.view');

    /* 결제 테스트 */
    Route::get('/dev/payment/{reservation}', 'Payple\PaymentController@devIndex')->name('dev.payment.order');
    Route::post('/dev/payment/store', 'Payple\PaymentController@store')->name('dev.payment.store');

    /* 관리자 결제 취소 처리 기능 */
    Route::prefix('payment')->group(function () {
        Route::get('/cancel/{reservation}', 'Payple\PaymentController@cancel')->name('payment.cancel');
    });

    /* 관리자 결제 생성 기능 */
    Route::prefix('information')->name('information.')->group(function () {
        Route::get('/', 'Admins\InformationGenerationController@index')->name('index');
        Route::get('/reservation/form/{order_id}/{reservation_id?}', 'Admins\InformationGenerationController@reservationForm')->name('reservation.form');
        Route::get('/{reservation_id?}', 'Admins\InformationGenerationController@alertTalkList')->name('alertTalkList');
    });
    Route::get('/users-master-table', 'Admins\AdminController@userMasterTable')->name('users-master-table');

    /* 관리자 호텔 별 기간 설정 */
    Route::prefix('term')->name('hotel.term.')->group(function () {
        Route::get('/{hotel_id}', 'Hotels\TermController@index')->name('index');
        Route::get('/edit/{term}', 'Hotels\TermController@edit')->name('edit');
        Route::get('/destroy/{term}', 'Hotels\TermController@destroy')->name('destroy');
    });
    /* 엑셀  */
    Route::middleware('throttle:3,1')->prefix('excel')->name('excel.')->group(function () {
        Route::get('/export/unpaid', 'Admins\AdminController@exportUnpaid')->name('unpaid');
        Route::get('/export/user/all', 'Admins\AdminController@exportUserAll')->name('user.all');
        Route::get('/export/recommendation', 'Admins\AdminController@exportRecommendation')->name('recommendation');
        Route::get('/export/hotel/reservation', 'Admins\AdminController@exportHotelReservation')->name('hotel.reservation');
        Route::post('/export/hotel/reservation/options', 'Admins\AdminController@exportHotelReservationOptions')->name('hotel.reservation.option');
    });

    //호텔 정렬
    Route::get('/hotel/sort/{hotel}', 'Hotels\HotelController@hotelSort')->name('hotel.sort');

    // 슈퍼 어드민 이상 관리자 권한 지정 처리 등
    Route::group(['middleware' => ['role:super-admin']], function () {
        Route::get('/permission/{tab?}', 'Admins\AdminController@adminPermission')->name('admin.permission');
        Route::get('/permission/edit/{user}', 'Admins\AdminController@adminPermissionEdit')->name('admin.permission.edit');
        Route::get('/admins/create', 'Admins\AdminController@adminCreate')->name('admins.create');/*관리자 생성 폼*/
        Route::post('/admins', 'Admins\AdminController@adminStore')->name('admins.store');/*관리자 생성*/

        /* 역활 생성*/
        Route::post('/role/offer/{type}', 'Admins\AdminController@roleOffer')->name('admin.role.offer');
        /* User 역활&권한&호텔관리자 적용 */
        Route::post('/permission/application/{user}/{type}', 'Admins\AdminController@permissionApplication')->name('admin.permission.application');
        /* 권한 생성*/
        Route::post('/permission/offer/{type}', 'Admins\AdminController@permissionOffer')->name('admin.permission.offer');
    });

    //취소 신청 확인 & 변경 신청 확인
    Route::prefix('reservation')->name('admin.reservation.')->group(function () {
        Route::get('/application', 'Admins\AdminController@reservationApplicationIndex')->name('application.index');
        Route::get('/application/{reservation?}', 'Admins\AdminController@reservationApplicationShow')->name('application.show');

        Route::POST('/application/reservation-modify', 'Admins\AdminController@reservationModifyProcess')->name('modify.process');
        Route::POST('/application/reservation-cancel', 'Admins\AdminController@reservationCancelProcess')->name('cancel.process');
    });

    /* 정산 관리자 */
    Route::group(['middleware' => ['permission:settlement manager']], function () {
        Route::prefix('settlements')->name('admin.')->group(function(){
            Route::get('/', 'Admins\SettlementController@index')->name('settlements.index');
            Route::get('{settlement}', 'Admins\SettlementController@show')->name('settlements.show');
            Route::post('settlements/{settlement}/restore', 'Admins\SettlementController@settlementRestore')->name('settlements.restore');
            Route::patch('settlements/{settlement}', 'Admins\SettlementController@update')->name('settlements.update');
            Route::delete('settlements/{settlement}', 'Admins\SettlementController@destroy')->name('settlements.destroy');
        });
    });

    /* 호텔 별 스케줄러 */
    Route::group(['middleware' => ['permission:schedulers permission']], function () {
        Route::prefix('scheduler')->name('admin.')->group(function(){
            Route::get('/', [SchedulerController::class, 'index'])->name('schedulers.index');
            Route::get('/hotel/detail/{hotel}', [SchedulerController::class, 'hotelDetail'])->name('schedulers.hotel-detail');
        });
    });

    /* 호텔 Copy */
    Route::group(['middleware' => ['permission:hotel copy']], function () {
        Route::prefix('hotel-copy')->name('admin.')->group(function(){
            Route::get('/', [CopyController::class, 'index'])->name('hotel-copy.index');

        });
    });

    /* 정산 관리자 */
    Route::group(['middleware' => ['permission:getListEnterHotel']], function () {
        Route::prefix('hotel-enter')->name('admin.')->group(function(){
            Route::get('/', [\App\Http\Controllers\Admins\EnterController::class, 'index'])->name('hotel-enter.index');
            Route::get('/{hotel}', [\App\Http\Controllers\Admins\EnterController::class, 'show'])->name('hotel-enter.show');
//            Route::post('settlements/{settlement}/restore', 'Admins\SettlementController@settlementRestore')->name('hotel-enter.restore');
//            Route::patch('settlements/{settlement}', 'Admins\SettlementController@update')->name('hotel-enter.update');
//            Route::delete('settlements/{settlement}', 'Admins\SettlementController@destroy')->name('hotel-enter.destroy');
        });
    });

});



/*---------------------------------------------- 관리자 용 끝 ----------------------------------------------*/

/*---------------------------------------------- 호텔 매니저 시작 ----------------------------------------------*/
/* 호텔 매니저 가입 처리 */
Route::prefix('apply')->name('enter.')->group(function () {
    Route::get('/hotel', 'Hotels\EnterController@index')->name('hotel');
    Route::get('/hotel/manager/create', [EnterController::class, 'managerCreate'])->name('hotel-manager');
    Route::get('/hotel/manager/create-completed', [EnterController::class, 'managerCreateCompleted'])->middleware(['role:hotel', 'auth'])->name('hotel-manager.create-completed');
});

/* 호텔 매니저 */
Route::prefix('hotel-manager')->name('hotel-manager.')->middleware(['role:hotel', 'auth'])->group(function () {
    Route::get('/main', [HotelManagerController::class, 'index'])->name('index');
    Route::get('/hotel-management', [HotelManagerController::class, 'hotelManagement'])->name('hotel-management');
    Route::get('/info-modify', [HotelManagerController::class, 'infoModify'])->name('info-modify');
    Route::get('/dash-board/{tab?}/{list?}', [HotelManagerController::class, 'dashBoard'])->name('dash-board');
});

/* 호텔 입점 신청 */
Route::prefix('hotel-entry')->name('hotel-entry.')->middleware(['role:hotel', 'auth','cors'])->group(function () {
    Route::get('/{hotel?}/{tab?}', [HotelEntryController::class, 'entryHotel'])->name('hotel');
    Route::get('/edit/hotel/{addHotel}', [HotelEntryController::class, 'updateFormHotel'])->name('update-form');
    Route::post('/hotel/check-list/{addHotel}', [HotelEntryController::class, 'checkList'])->name('check-list');
});
/*---------------------------------------------- 호텔 매니저 끝 ----------------------------------------------*/

Route::prefix('admin')->middleware(['role:super-admin|admin', 'auth'])->group(function () {
    /* 관리자 결제 생성 기능 */
    Route::prefix('information')->name('information.')->group(function () {
        Route::get('/', 'Admins\InformationGenerationController@index')->name('index');
        Route::get('/reservation/form/{order_id}/{reservation_id?}', 'Admins\InformationGenerationController@reservationForm')->name('reservation.form');
        Route::get('/{reservation_id?}', 'Admins\InformationGenerationController@alertTalkList')->name('alertTalkList');
    });
});
/* 호텔별 일정 API */
Route::get('fullcalender/{hotel_id}', 'FullCalenderController@index')->name('fullcalender');
Route::post('fullcalenderAjax', 'FullCalenderController@ajax')->name('fullcalenderAjax');

/* 회원 주문 처리 */
Route::prefix('payment')->group(function () {
    Route::get('/{reservation}/{method?}', 'Payple\PaymentController@index')->name('payment.order');
    Route::post('/store', 'Payple\PaymentController@store')->name('payment.store');
    Route::post('/store/rest/process', 'Payple\PaymentController@storeRestProcess')->name('payment.store.rest.process');
});

/* 주문 / 투어신청 완료 페이지 */
Route::get('/reservations/hotel/completed/{reservation?}','Hotels\HotelController@reservationCompleted')->name('reservations.completed');
/* 주문 / 결제 완료 페이지*/
Route::get('/reservations/hotel/order_completed/{reservation?}', 'Hotels\HotelController@reservationOrderCompleted')->name('reservations.order_completed');
/* 결제 인증 */
Route::post('/payple/auth', 'Payple\PaymentController@paypleAuth')->name('payple.auth');
Route::post('/payple/cancel-auth', 'Payple\PaymentController@paypleCancelAuth')->name('payple.cancel-auth');

/* 외부 API 인증 */
Route::prefix('external')->group(function () {
    /* 확정 처리 진행 */
    Route::get('/hotel/confirmation/checking/{key?}', 'External\ExternalController@confirmationChecking')->name('external.hotel.confirmation.checking');
    Route::get('/hotel/confirmation/{key?}', 'External\ExternalController@confirmation')->name('external.hotel.confirmation');

    /* 변경 필요 진행 */
    Route::get('/hotel/confirmation-change/checking/{key?}', 'External\ExternalController@confirmationChangeChecking')->name('external.hotel.confirmation.change.checking');
    Route::get('/hotel/confirmation-change/{key?}', 'External\ExternalController@confirmationChange')->name('external.hotel.confirmation.change');

    /*메일 수신 차단 필요 메일*/
    Route::get('/hotel/confirmation-block/checking/{key?}', 'External\ExternalController@mailBlockChecking')->name('external.hotel.mail.block.checking');
    Route::get('/hotel/confirmation-block/{key?}', 'External\ExternalController@mailBlock')->name('external.hotel.mail.block');
});

/* 고객 회원가입 완료 후 > 추천 페이지 */
Route::get('/register/completed', 'Customers\CustomerController@registerCompleted')->name('register.completed');

/* 고객 관련 페이지 */
Route::prefix('customer')->name('customer.')->middleware(['auth'])->group(function () {
    Route::post('/auth-form', 'Customers\CustomerController@authForm')->name('auth-form');
});

/* 마이 페이지 */
Route::prefix('my-page')->name('my-page.')->middleware(['auth'])->group(function () {
    Route::get('/{tab?}', 'Customers\CustomerController@index')->name('main');/* 메인 접근*/
    Route::get('/auth/modify/{type}', 'Customers\CustomerController@modifyForm')->name('auth.modify');/*개인정보수정*/
    Route::get('/edit/info', 'Customers\CustomerController@editUserInfo')->name('edit');
    Route::POST('/reservation/modify/{reservation?}', 'Customers\CustomerController@reservationModifyForm')->name('reservation.modify');/*주문수정*/
});

/* 이니시스 결제 */

Route::get('payment/inicis', [InicisController::class, 'inicisReturn'])->name('inicis.return');


/* 회원 가입 */
Route::get('/user/register', 'Auth\LoginController@userRegister')->name('user.register');//route('login_social',['type=>'kakao']);
/* 회원 패스워드 (이메일, 이름) 찾기 */
Route::get('/user/password-search', 'Auth\LoginController@passworSdearch')->name('user.password-search');//route('login_social',['type=>'kakao']);
Route::get('/login/user', 'Auth\LoginController@userPasswordNeedChange')->name('user.password-need-change');//route('login_social',['type=>'kakao']);
Route::get('/login/social/{type?}', 'Auth\LoginController@redirectToProvider')->name('login_social');//route('login_social',['type=>'kakao']);
Route::get('/login/social/callback/{type?}', 'Auth\LoginController@handleProviderCallback')->name('login_social_callback');

Route::get('/close', 'HomeController@close')->name('popup_close');
