<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;

class HotelManagerController extends Controller
{

    /* 호텔 매니저 메인 */
    public function index()
    {
        return view('hotel-manager.index');
    }

    /* 호텔 입점 신청 리스트 */
    public function hotelManagement()
    {
        return view('hotel-manager.hotel-management');
    }

    /* 호텔 매니저 이메일, 비밀번호 변경 form */
    public function infoModify()
    {
        return view('hotel-manager.info-modify');
    }

    /* 주문 관리 폼 접근 */
	public function dashBoard($tab=0, $list='all-list')
	{
        return view('hotel-manager.dash-board')->with(['tab'=>$tab, 'list'=> $list]);
	}


}
