<?php

namespace App\Http\Controllers\Customers;

use App\Hotel;
use App\HotelReservation;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index($tab=null)
    {
        return view('customer.my-page',[
            'tab'=>$tab
        ]);
    }

    /*개인정보 수정*/
    public function editUserInfo() {
        return view('customer.edit-user-info');
    }

    /*회원가입 완료*/
    public function registerCompleted()
    {
        return view('register.completed', [
            'hotels' => Hotel::where('status', '=', '2')->where('curator', '=', 'N')->inRandomOrder()->limit(2)->get()
        ]);
    }
    /* 주문 수정 신청 폼 접근 */
    public function reservationModifyForm(HotelReservation $reservation)
    {

        return view('customer.reservation.modify', [
            'reservation' => $reservation
        ]);


    }
    /* 비밀번호 변경 접근 */
    public function authForm()
    {
        if (Auth::check()) {
            return view('auth.certification');
        }
        abort(404);
    }
    /* 비밀번호 변경 접근 */
    public function modifyForm($type=null)
    {
        if($type === null){
            abort(404);
        }
        return view('auth.modify.form', [
            'type'=>$type
        ]);
    }
}
