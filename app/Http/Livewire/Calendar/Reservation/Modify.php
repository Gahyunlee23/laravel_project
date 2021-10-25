<?php

namespace App\Http\Livewire\Calendar\Reservation;

use App\HotelReservation;
use App\ReservationModify;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class Modify extends Component
{
    public $type;
    public $reservation;
    public $disable;
    public $start;
    public $end;
    public $startYear,$startMonth,$startDate;
    public $endYear,$endMonth,$endDate;

    protected $listeners = [
        'calendarChangeStatEvent' => 'disableStatChange',
        'reservationModifyApplicationEvent'=>'reservationModifyApplication'
    ];

    public function disableStatChange($stat): void
    {
        $this->disable = $stat;
        $this->render();
    }

    public function mount(): void
    {
        $this->disableStatChange('1');
    }

    public function render()
    {
        return view('livewire.calendar.reservation.modify');
    }


    public function reservationModifyApplication($start,$end,$SelectStart,$SelectEnd,$diff){
        if($this->type ==='start'){
            $StartDt=Carbon::parse($start[0].'-'.$start[1].'-'.$start[2])->format('Y-m-d');
            $EndDt=Carbon::parse($end[0].'-'.$end[1].'-'.$end[2])->format('Y-m-d');
            $modifyStartDt=Carbon::parse($SelectStart[0].'-'.$SelectStart[1].'-'.$SelectStart[2])->format('Y-m-d');
            $modifyEndDt=Carbon::parse($SelectEnd[0].'-'.$SelectEnd[1].'-'.$SelectEnd[2])->format('Y-m-d');
            if(isset($this->reservation->confirmation)){
                $StartDt.=' '.Carbon::parse($this->reservation->confirmation->start_dt)->format('H:i:s');
                $EndDt.=' '.Carbon::parse($this->reservation->confirmation->end_dt)->format('H:i:s');
                $modifyStartDt.=' '.Carbon::parse($this->reservation->confirmation->start_dt)->format('H:i:s');
                $modifyEndDt.=' '.Carbon::parse($this->reservation->confirmation->end_dt)->format('H:i:s');
            }
            ReservationModify::create([
                'reservation_id'=>$this->reservation->id,
                'user_id'=>auth()->user()->id,
                'process'=>'1',
                'diff_day'=>$diff,
                'before_start_dt'=>$StartDt,
                'before_end_dt'=>$EndDt,
                'start_dt'=>$modifyStartDt,
                'end_dt'=>$modifyEndDt,
                'send_dt'=>now(),
            ]);
            $this->reservation = HotelReservation::where('id','=',$this->reservation->id)->first();
            $admins = [
                'hotelmanager@travelmakers.kr'
            ];
            /* 'hotelmanager@travelmakers.kr'*/

            foreach ($admins as $index => $email) {
                Mail::send('emails.reservation_modify', ['reservation'=>$this->reservation], function ($message) use ($email) {
                    $message->to($email, '트메 관리자')->subject('[호텔에삶/고객/변경신청]'.($this->reservation->order_name ?? '고객').'님 호텔 입주 기간 변경 신청');
                    $message->from(env('MAIL_USERNAME'), env('MAIL_NICKNAME'));
                });
            }
            $this->emitUp('reservationModifyCalendarChangeStatEvent',1);
        }
    }
}
