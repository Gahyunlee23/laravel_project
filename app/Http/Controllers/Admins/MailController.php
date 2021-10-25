<?php

namespace App\Http\Controllers\Admins;

use App\External;
use App\HotelReservation;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function confirmation ($type='확정',HotelReservation $reservation = null){
        if($reservation===null){
            $reservation = HotelReservation::where('type', '=', 'month')
                ->whereIn('order_status', ['3', '5'])->latest()->limit(1)->first();
        }
        return view('emails.outer.order_completed_confirmation', [
            'subject'=> '[호텔에삶]'.$reservation->order_name.'님 입주 '.$type.'되었습니다.',
            'type'=>$type,
            'reservation' => $reservation,
        ]);
    }

    public function confirmationComplete (HotelReservation $reservation ){
        return view('emails.outer.confirmation', [
            'reservation' => $reservation,
        ]);
    }

    public function reschedule ($type='확정',HotelReservation $reservation = null){
        if($reservation===null){
            $reservation = HotelReservation::where('type', '=', 'month')
                ->whereIn('order_status', ['3', '5'])->latest()->limit(1)->first();
        }

        $external=External::create([
            'reservation_id'=>$reservation->id,
            'hotel_id'=>$reservation->hotel_id,
            'access_key'=>Str::random(60),
            'access_at'=> Carbon::now(),
            'access_end_at'=> Carbon::now()->addDays(3),
            'memo'=>'[DEV]'.$reservation->type.' '.$type.' 확정 문의 호텔관리자에게 전달',
            'type'=>'outer-order-completed',
            'status'=>'1'
        ]);
        return view('emails.outer.reschedule', [
            'reservation' => $reservation,
            'reschedule_type'=>$type,
            'external'=>$external
        ]);
    }
}
