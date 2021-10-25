<?php

namespace App\Http\Livewire\Customer\Reservation;

use App\HotelReservation;
use App\ReservationCancel;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Modify extends Component
{
    public $reservation;
    public $calendarDisable='1';

    protected $listeners = [
        'reservationModifyBaseRerenderEvent'=>'render',
        'reservationModifyCalendarChangeStatEvent'=>'calendarChangeStat',

    ];
    public function render()
    {
        return view('livewire.customer.reservation.modify');
    }

    public function calendarChangeStat($disable): void
    {
        if($disable !== '1'){
            $this->calendarDisable = '1';
        }else{
            $this->calendarDisable = '0';
        }
        $this->emit('calendarChangeStatEvent', $this->calendarDisable);
        $this->dispatchBrowserEvent('documentHeightCheck');
    }
    public function reservationCancel(HotelReservation $reservation): void
    {

        ReservationCancel::create([
           'reservation_id'=>$reservation->id,
           'user_id'=>auth()->user()->id,
           'process'=>'1',
           'send_dt'=>now(),
        ]);

        $admins = [
            'hotelmanager@travelmakers.kr'/*travelmakerkorea*/
        ];

        foreach ($admins as $index => $email) {
            Mail::send('emails.reservation_cancel', ['reservation'=>$reservation], function ($message) use ($email,$reservation) {
                $message->to($email, '트메 관리자')->subject('[호텔에삶/고객/취소신청]'.($reservation->order_name ?? '고객').'님 호텔 입주 취소 신청');
                $message->from(env('MAIL_USERNAME'), env('MAIL_NICKNAME'));
            });
        }

    }
}
