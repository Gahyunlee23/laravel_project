<?php

namespace App\Http\Controllers\Schedules;

use App\AlertTalk;
use App\AlertTalkList;
use App\Confirmation;
use App\Curator;
use App\Formatter;
use App\Hotel;
use App\HotelReservation;
use App\HotelRoom;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Schedule;
use App\Template;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ScheduleController extends Controller
{

    /* 입주 확정 인원 > 입주 1일전 알림톡 전송 처리*/
    public function oneDaysBeforeLivingInHotel(): void
    {
        $confirmations=Confirmation::whereStatus('1')
            ->whereBetween('start_dt',$this->ArrDateReturn(1,2,'add'))
            ->whereType('LivingInHotel')
            ->whereNull('before_1day')
        ->get();

        if($confirmations->count()>=1){
            $formatter = new Formatter();
            $template = Template::whereCatalog('입주 전')->whereUse('1')->first();
            foreach ($confirmations as $confirmation) {
                if($confirmation->reservation->order_status !== '0'){
                    $hotel_option = $confirmation->reservation->hotel->options->where('disable', '=', 'N')->first();

                    $template_content = $formatter->templateFormat($template->template, [
                        '#{회원명}' => $confirmation->reservation->order_name,
                        '#{before_day}' => '1일',
                        '#{체크인시간}' => $formatter->carbonFormat($confirmation->start_dt, 'H시i분') . ' 이후',
                        '#{호텔주소}' => $hotel_option->area,
                        '#{입주확정일자}' => $formatter->carbonFormat($confirmation->start_dt, 'Y년 m월 d일(요일)'),
                        '#{퇴실일자}' => $formatter->carbonFormat($confirmation->end_dt, 'Y년 m월 d일(요일)')
                    ]);
                    $buttons=[
                        "button_type" => 'WL',
                        "button_name" => '호텔에삶 이용안내서',
                        "button_url" => $confirmation->reservation->hotel->info_notion,
                        "button_url2" => $confirmation->reservation->hotel->info_notion
                    ];
                    $this->AlertTalkService([
                        'reserved_time' => '',/*예약시간*/
                        're_send' => 'Y',
                        'tel' => $formatter->hpFormat($confirmation->reservation->order_hp),
                        'template_code' => $template->code,
                        'template' => $template_content
                    ], $buttons);

                    $confirmation->before_1day = date('Y-m-d H:i:s');
                    $confirmation->save();

                    $this->AlertTalkListCreating($template_content, $template, $confirmation, $buttons);
                }
            }
        }
    }

    /* 입주 확정 인원 > 입주 3일전 알림톡 전송 처리*/
    public function threeDaysBeforeLiveInHotel(): void
    {
        $confirmations=Confirmation::whereStatus('1')
            ->whereBetween('start_dt', [now(), now()->addDays(3)])
            ->whereType('LivingInHotel')
            ->whereNull('before_3day')
            ->get();

        if($confirmations->count()>=1){
            $formatter = new Formatter();
            $template=Template::whereCatalog('입주 전')->whereUse('1')->first();
            foreach ($confirmations as $confirmation) {
                if($confirmation->reservation->order_status !== '0'){
                    $hotel_option = $confirmation->reservation->hotel->options->where('disable','=','N')->first();

                    $template_content = $formatter->templateFormat($template->template, [
                        '#{회원명}' => $confirmation->reservation->order_name,
                        '#{before_day}' => Carbon::parse($confirmation->start_dt)->diff(Carbon::today())->days.'일',
                        '#{체크인시간}' => $formatter->carbonFormat($confirmation->start_dt, 'H시i분') . ' 이후',
                        '#{호텔주소}' => $hotel_option->area,
                        '#{입주확정일자}' => $formatter->carbonFormat($confirmation->start_dt, 'Y년 m월 d일(요일)'),
                        '#{퇴실일자}' => $formatter->carbonFormat($confirmation->end_dt, 'Y년 m월 d일(요일)')
                    ]);
                    $buttons=[
                        "button_type" => 'WL',
                        "button_name" => '호텔에삶 이용안내서',
                        "button_url" => $confirmation->reservation->hotel->info_notion,
                        "button_url2" => $confirmation->reservation->hotel->info_notion
                    ];
                    $this->AlertTalkService([
                        'reserved_time' => '',/*예약시간*/
                        're_send' => 'Y',
                        'tel' => $formatter->hpFormat($confirmation->reservation->order_hp),
                        'template_code' => $template->code,
                        'template' => $template_content
                    ], $buttons);

                    $confirmation->before_3day = date('Y-m-d H:i:s');
                    $confirmation->save();

                    $this->AlertTalkListCreating($template_content, $template, $confirmation, $buttons);
                }
            }
        }
    }

    /* 투어 후 2시간  */
    public function twoHoursAfterHotelTour(): void
    {
        $confirmations=Confirmation::whereStatus('1')
            ->whereBetween('start_dt',$this->ArrHourReturn(3,2,'sub'))
            ->whereType('HotelTour')
            ->whereNull('tour_after')
            ->get();
        if($confirmations->count()>=1){
            $formatter = new Formatter();
            $template=Template::whereCatalog('투어 후')->whereUse('1')->first();
            foreach ($confirmations as $confirmation){
                if($confirmation->reservation->order_status !== '0'){

                    $hotel_option = $confirmation->reservation->hotel->options->where('disable','=','N')->first();
                    $template_content=$formatter->templateFormat($template->template, [
                        '#{회원명}' => $confirmation->reservation->order_name,
                        '#{호텔명}' => $hotel_option->title,
                    ]);
                    $this->AlertTalkService([
                        'reserved_time'=>'',/*예약시간*/
                        're_send'=>'Y',
                        'tel' => $formatter->hpFormat($confirmation->reservation->order_hp),
                        'template_code' => $template->code,
                        'template' => $template_content
                    ],null);

                    $confirmation->tour_after=date('Y-m-d H:i:s');
                    $confirmation->save();

                    $this->AlertTalkListCreating($template_content, $template, $confirmation);
                }
            }
        }
    }

    public function oneHourAfterHotelTour(): void
    {
        $catalog='투어 후';
        $confirmations=Confirmation::with([
        'alertTalkLists'=>function($query) use ($catalog){
            $query->whereCatalog($catalog)
                ->whereBetween('send_at', [Carbon::now()->subDay(), Carbon::now()]);
        }])
        ->whereStatus('1')
        ->whereBetween('start_dt', $this->ArrHourReturn(3,1,'sub'))
        ->whereType('HotelTour')
        ->get();

        if($confirmations->count()>=1){
            $formatter = new Formatter();
            $template = Template::whereCatalog($catalog)->whereUse('1')->first();
            foreach ($confirmations as $confirmation){
                if($confirmation->alertTalkLists->count() === 0 && $confirmation->reservation->order_status !== '0'){

                    $hotel_option = $confirmation->reservation->hotel->options->where('disable','=','N')->first();
                    $template_content=$formatter->templateFormat($template->template, [
                        '#{회원명}' => $confirmation->reservation->order_name,
                        '#{호텔명}' => $hotel_option->title,
                    ]);
                    $this->AlertTalkService([
                        'reserved_time'=>'',/*예약시간*/
                        're_send'=>'Y',
                        'tel' => $formatter->hpFormat($confirmation->reservation->order_hp),
                        'template_code' => $template->code,
                        'template' => $template_content
                    ],null);

                    $confirmation->tour_after=date('Y-m-d H:i:s');
                    $confirmation->save();

                    $this->AlertTalkListCreating($template_content, $template, $confirmation);
                }
            }
        }
    }

    /* 투어 하루 전 - 재확인 */
    public function oneDayBeforeHotelTour(): void
    {
        $catalog='투어 재확인';
        $confirmations=Confirmation::with([
            'alertTalkLists'=>function($query) use ($catalog){
                $query->whereCatalog($catalog)
                    ->whereBetween('send_at', [Carbon::now()->subDay(), Carbon::now()]);
            }])
        ->whereStatus('1')
        ->whereType('HotelTour')
        ->whereBetween('start_dt',$this->ArrDateReturn(1,2,'add'))
        ->get();

        if($confirmations->count()>=1){
            $formatter = new Formatter();
            $template = Template::whereCatalog($catalog)->whereUse('1')->first();
            foreach ($confirmations as $confirmation){
                if($confirmation->alertTalkLists->count() === 0 && $confirmation->reservation->order_status !== '0'){
                    $hotel_option = $confirmation->reservation->hotel->options->where('disable','=','N')->first();
                    $template_content=$formatter->templateFormat($template->template, [
                        '#{회원명}' => $confirmation->reservation->order_name,
                        '#{호텔명}' => $hotel_option->title,
                        '#{기간}' => '하루',
                        '#{투어일자}' => $formatter->carbonFormat($confirmation->start_dt,'Y년 m월 d일(요일) H시 i분')
                    ]);
                    $this->AlertTalkService([
                        'reserved_time'=>'',/*예약시간*/
                        're_send'=>'Y',
                        'tel' => $formatter->hpFormat($confirmation->reservation->order_hp),
                        'template_code' => $template->code,
                        'template' => $template_content
                    ],null);

                    $this->AlertTalkListCreating($template_content, $template, $confirmation);
                }
            }
        }
    }

    /* 투어 2시간 전 재재확인 */
    public function twoHoursBeforeHotelTour(): void
    {
        $catalog='투어 재재확인';
        $confirmations=Confirmation::with([
            'alertTalkLists'=>function($query) use ($catalog){
                $query->whereCatalog($catalog)
                    ->whereBetween('send_at', [Carbon::now()->subDay(), Carbon::now()]);
            }])
        ->whereStatus('1')
        ->whereType('HotelTour')
        ->whereBetween('start_dt',$this->ArrHourReturn(1,2,'add'))
        ->get();

        if($confirmations->count()>=1){
            $formatter = new Formatter();
            $template = Template::whereCatalog($catalog)->whereUse('1')->first();
            foreach ($confirmations as $confirmation){
                if($confirmation->alertTalkLists->count() === 0 && $confirmation->reservation->order_status !== '0'){
                    $hotel_option = $confirmation->reservation->hotel->options->where('disable','=','N')->first();
                    $template_content=$formatter->templateFormat($template->template, [
                        '#{기간}' => '오늘',
                        '#{호텔명}' => $hotel_option->title,
                        '#{투어시간}' => $formatter->carbonFormat($confirmation->start_dt,'H시i분')
                    ]);
                    $this->AlertTalkService([
                        'reserved_time'=>'',/*예약시간*/
                        're_send'=>'Y',
                        'tel' => $formatter->hpFormat($confirmation->reservation->order_hp),
                        'template_code' => $template->code,
                        'template' => $template_content
                    ],null);
                    $this->AlertTalkListCreating($template_content, $template, $confirmation);
                }
            }
        }
    }

    /* 입주 1일 후 */
    public function oneDaysAfterLivingInHotel(): void
    {
        $confirmations=Confirmation::whereStatus('1')
            ->whereBetween('start_dt', $this->ArrDateReturn(1,0,'sub'))
            ->whereType('LivingInHotel')
            ->whereNull('after_1day')
            ->get();

        if($confirmations->count()>=1){
            $formatter = new Formatter();
            $template=Template::whereCatalog('입주 1일 후')->whereUse('1')->first();
            foreach ($confirmations as $confirmation){
                if($confirmation->reservation->order_status !== '0'){
                    //$hotel_option = $confirmation->reservation->hotel->options->where('disable','=','N')->first();
                    $template_content = $formatter->templateFormat($template->template, [
                        '#{회원명}' => $confirmation->reservation->order_name
                    ]);
                    $this->AlertTalkService([
                        'reserved_time'=>'',/*예약시간*/
                        're_send'=>'Y',
                        'tel' => $formatter->hpFormat($confirmation->reservation->order_hp),
                        'template_code' => $template->code,
                        'template' => $template_content
                    ],null);

                    $confirmation->after_1day=date('Y-m-d H:i:s');
                    $confirmation->save();

                    $this->AlertTalkListCreating($template_content, $template, $confirmation);
                }
            }
        }
    }

    /* 퇴실 3일전 알림톡 전송 처리*/
//    public function threeDaysBeforeLivingInHotel(): void
//    {
//        $confirmations=Confirmation::whereStatus('1')
//            ->whereBetween('end_dt',$this->ArrDateReturn(3,4,'add'))
//            ->whereType('LivingInHotel')
//            ->whereNull('last_3day')
//            ->get();
//        if($confirmations->count()>=1){
//            $formatter = new Formatter();
//            $template_catalog='퇴실 전';
//            $template = Template::whereCatalog($template_catalog)->whereUse('1')->first();
//            foreach ($confirmations as $confirmation){
//
//                if($confirmation->reservation->order_status !== '0'){
//                    $hotel_option = $confirmation->reservation->hotel->options->where('disable','=','N')->first();
//                    $template_content = $formatter->templateFormat($template->template, [
//                        '#{회원명}' => $confirmation->reservation->order_name ?? '',
//                        '#{호텔명}' => $hotel_option->title ?? '',
//                        '#{last_day}' => '3일'
//                    ]);
//
//                    $this->AlertTalkService([
//                        'reserved_time'=>'',/*예약시간*/
//                        're_send'=>'Y',
//                        'tel' => $formatter->hpFormat($confirmation->reservation->order_hp),
//                        'template_code' => $template->code,
//                        'template' => $template_content
//                    ], null);
//                    /*[
//                        "button_type" => 'MD',
//                        "button_name" => '호텔에삶 연장하기'
//                    ]*/
//
//                    $confirmation->last_3day=date('Y-m-d H:i:s');
//                    $confirmation->save();
//
//                    $this->AlertTalkListCreating($template_content,$template,$confirmation);
//                }
//            }
//        }
//    }

    /* 퇴실 5 ~ 7일 전 호텔별 체크 알림톡 전송 처리 -> 퇴실 날짜 변경 요청 : 기존 ) 퇴실 4일 20시간 전 (퇴실 4일전 표기), 변경 ) 퇴실 4일 20시간 전 (퇴실 5일전) */
    public function DaysBeforeLivingInHotel(): void
    {
        $template_catalog='퇴실 전';
        $confirmations=Confirmation::whereDoesntHave('alertTalkLists', function ($q) use ($template_catalog){
            $q->whereCatalog($template_catalog);
        })->where(function($q){
            $q->whereHas('reservation.hotel', function ($q){
                $q->where(function($q){
                    $q->whereIn('id', ['41','75','23','46','74'])
                        ->whereBetween('end_dt', [Carbon::today()->addDays(8)->format('Y-m-d H:i:s'),
                            Carbon::today()->addDays(9)->subSecond()->format('Y-m-d H:i:s')]);
                });
                $q->orWhere(function($q){
                    $q->whereBetween('end_dt', [Carbon::today()->addDays(6)->format('Y-m-d H:i:s'),
                        Carbon::today()->addDays(7)->subSecond()->format('Y-m-d H:i:s')]);
                });
            });
        })
            ->whereType('LivingInHotel')
            ->whereStatus('1')
            ->get();

        if($confirmations->count()>=1){
            $formatter = new Formatter();
            $template = Template::whereCatalog($template_catalog)->whereUse('1')->first();
            foreach ($confirmations as $confirmation){

                if($confirmation->reservation->order_status !== '0'){
                    $hotel_option = $confirmation->reservation->hotel->options->where('disable','=','N')->first();
                    $last_day=now()->diffInDays($confirmation->end_dt);
                    $hour = now()->diffInHours($confirmation->end_dt);
                    if($last_day === 4 || $last_day === 6) {
                        if( ($hour - ( 24 * $last_day )) >= 12){
                            $last_day++;
                        }
                    }
                    $template_content = $formatter->templateFormat($template->template, [
                        '#{회원명}' => $confirmation->reservation->order_name ?? '',
                        '#{호텔명}' => $hotel_option->title ?? '',
                        '#{last_day}' => $last_day.'일'
                    ]);

                    $this->AlertTalkService([
                        'reserved_time'=>'',/*예약시간*/
                        're_send'=>'Y',
                        'tel' => $formatter->hpFormat($confirmation->reservation->order_hp),
                        'template_code' => $template->code,
                        'template' => $template_content
                    ], null);
                    /*[
                        "button_type" => 'MD',
                        "button_name" => '호텔에삶 연장하기'
                    ]*/

                    $confirmation->last_3day=date('Y-m-d H:i:s');
                    $confirmation->save();

                    $this->AlertTalkListCreating($template_content,$template,$confirmation);
                }
            }
        }
    }
    /* 퇴실 1일전 알림톡 전송 처리*/
    public function ADayBeforeLivingInHotel(): void
    {
        $template_catalog='퇴실 24시간 전';
        $confirmations=Confirmation::withCount([
                'alertTalkLists'=>function($query) use ($template_catalog){
                    $query->whereCatalog($template_catalog);
                }
            ])->whereStatus('1')
            ->whereBetween('end_dt', [Carbon::now()->addHours(23)->format('Y-m-d H:i:s'), Carbon::now()->addDays(1)->subSecond()->format('Y-m-d H:i:s')])
            ->whereType('LivingInHotel')
            ->get();

        if($confirmations->count()>=1){
            $formatter = new Formatter();
            $template = Template::whereCatalog($template_catalog)->whereUse('1')->first();
            foreach ($confirmations as $confirmation){
                if($confirmation->alert_talk_lists_count === 0 && ($confirmation->reservation->order_status === '3' || $confirmation->reservation->order_status === '5')){

                    $hotel_option = $confirmation->reservation->hotel->options->where('disable','=','N')->first();
                    $template_content = $formatter->templateFormat($template->template, [
                        '#{회원명}' => $confirmation->reservation->order_name,
                        '#{호텔명}' => $hotel_option->title,
                    ]);
                    $this->AlertTalkService([
                        'reserved_time'=>'',/*예약시간*/
                        're_send'=>'Y',
                        'tel' => $formatter->hpFormat($confirmation->reservation->order_hp),
                        'template_code' => $template->code,
                        'template' => $template_content
                    ],null);

                    $this->AlertTalkListCreating($template_content,$template,$confirmation);
                }
            }
        }
    }


    /* 퇴실 1일 후 알림톡 전송 처리*/
    public function oneDaysAfterLiveEndHotel(): void
    {
        $confirmations=Confirmation::whereStatus('1')
            ->whereBetween('end_dt',$this->ArrDateReturn(1,0,'sub'))
            ->whereType('LivingInHotel')
            ->whereNull('end_1day')
            ->get();

        if($confirmations->count()>=1){
            $formatter = new Formatter();
            $template = Template::whereCatalog('퇴실 후')->whereUse('1')->first();
            foreach ($confirmations as $confirmation){
                if($confirmation->reservation->order_status !== '0'){

                    $payment = Payment::whereReservationId($confirmation->reservation_id)->first();
                    if($payment){
                        $hotel_option = $confirmation->reservation->hotel->options->where('disable','=','N')->first();
                        $hotel_room = $confirmation->reservation->room;
                        $hotel_room_option = ( $hotel_room->nights !=='' ? '('.$hotel_room->nights.'박' : null ) .( $hotel_room->days !=='' ? ' '.$hotel_room->days.'일)' : null );
                        $hotel_room_options = $payment->goods_option;//.$hotel_room_option;

                        /*천제 호텔 판매 개수 랭킹 */
                        $reservations_ranking = HotelReservation::where('hotel_id','!=',$confirmation->reservation->hotel_id)
                        ->where(function($query){
                            $query->where('order_status','=','3')->orwhere('order_status','=','4')->orwhere('order_status','=','5');
                        })->groupBy('hotel_id')
                        ->selectRaw('count(hotel_id) as count, hotel_id')
                        ->pluck('count','hotel_id');

                        $button_url='https://www.livinginhotel.com';
                        if($reservations_ranking->search($reservations_ranking->max()) !== null){
                            $button_url='https://www.livinginhotel.com/hotel/'.$reservations_ranking->search($reservations_ranking->max());
                        }
                        $template_content = $formatter->templateFormat($template->template, [
                            '#{회원명}' => $confirmation->reservation->order_name,
                            '#{호텔명}' => $hotel_option->title,
                            '#{호텔옵션}' => $hotel_room_options
                        ]);
                        $this->AlertTalkService([
                            'reserved_time'=>'',/*예약시간*/
                            're_send'=>'Y',
                            'tel' => $formatter->hpFormat($confirmation->reservation->order_hp),
                            'template_code' => $template->code,
                            'template' => $template_content
                        ],[
                            "button_type" => 'WL',
                            "button_name" => '다른 호텔 둘러보기',
                            "button_url" => $button_url,
                            "button_url2" => $button_url
                        ]);

                        $confirmation->end_1day=date('Y-m-d H:i:s');
                        $confirmation->save();

                        $this->AlertTalkListCreating($template_content,$template,$confirmation);

                    }
                }
            }
        }
    }

    /* 결제 시도 > 닫기 > 후  */
    public function unsuccessfulPayment(): void
    {
        $timeArr=$this->ArrTimeReturn(12,10,'sub');
        $reservations=HotelReservation::withCount([
            'alertTalkLists'=>function($query){
                $query->whereCatalog('주문 이탈');
            }
        ])->whereIn('order_status', [2, 8])
        ->where('type', '=', 'month')
        ->whereBetween('updated_at', $timeArr)
        ->groupBy('user_id')
        ->get();

        if($reservations->count()>=1){
            $formatter = new Formatter();
            $template=Template::whereCatalog('주문 이탈')->whereUse('1')->first();
            foreach ($reservations as $reservation){
                if($reservation->alert_talk_lists_count === 0){

                    $reservation_count = HotelReservation::whereIn('order_status',[3,4,5])
                        ->where('order_name', '=',$reservation->order_name)
                        ->where('type', '=', 'month')
                    ->where('updated_at','>=',$reservation->updated_at)->count();

                    if($reservation_count === 0){

                        $checkReservations = HotelReservation::where('order_name', '=', $reservation->order_name)
                            ->whereIn('order_status', [2, 8])
                            ->whereDate('updated_at', now()->toDateString())
                            ->get();
                        $checkReservationAlertTalkCount = AlertTalkList::whereIn('reservation_id', $checkReservations->pluck('id')->toArray())
                            ->where('catalog', '=', '주문 이탈')
                            ->whereDate('created_at', now()->toDateString())
                            ->count();

                        if($checkReservationAlertTalkCount === 0){ /* 이전 정보 체크 해서 2번 전송 안되게 확인 */
                            $this->AlertTalkService([
                                'reserved_time'=>'',/*예약시간*/
                                're_send'=>'Y',
                                'tel' => $formatter->hpFormat($reservation->order_hp),
                                'template_code' => $template->code ?? 'error',
                                'template' => $template->template
                            ],null);

                            $this->AlertTalkListCreating($template->template, $template, null, null, $reservation);

                            $this->failMailSend($reservation->id);
                        }
                    }
                }
            }
        }
    }

    /* function */
    protected function AlertTalkService($data, $button): void
    {
        $at = null;
        if($button !== null){
            $at = new AlertTalk($data, $button);
        }else{
            $at = new AlertTalk($data);
        }
        $at->send();
    }

    protected function AlertTalkListCreating($template_content,$template,$confirmation=null,$buttons = null, $reservation=null): void
    {
        $formatter = new Formatter();

        $data = [
            'template_id'=>$template->id ?? null,
            'reservation_id'=>$confirmation->reservation_id ?? ($reservation->id ?? null),
            'payment_id'=>$confirmation->payment_id ?? null,
            'confirmation_id'=>$confirmation->id ?? null,
            'hotel_id'=>$confirmation->reservation->hotel->id ?? ($reservation->hotel->id ?? null),
            'room_id'=>$confirmation->reservation->room->id ?? ($reservation->room->id ?? null),
            'catalog'=>$template->catalog,
            'hp'=>$formatter->hpFormat($confirmation->reservation->order_hp ?? ($reservation->order_hp ?? null)),
            'result'=>'success',
            'template'=>$template_content,
            'send_at'=>Carbon::now()
        ];
        $collection = collect($data);
        if($buttons !== null){
            $collection = $collection->merge($buttons);
        }

        AlertTalkList::create($collection->toArray());
    }

    protected function ArrDateReturn($start_day, $end_day, $type){
        if($type === 'add'){
            return [Carbon::today()->addDays($start_day)->format('Y-m-d H:i:s'),Carbon::today()->addDays($end_day)->subSecond()->format('Y-m-d H:i:s')];
        }

        if($type==='sub'){
            /* 8  > 2,1    > 6 7-1초 6.23.59.59 */
            return [Carbon::today()->subDays($start_day)->subSecond()->format('Y-m-d H:i:s'),Carbon::today()->subDays($end_day)->format('Y-m-d H:i:s')];
        }

        return false;
    }
    protected function ArrHourReturn($start_hour, $end_hour, $type){
        if($type === 'add'){
            return [Carbon::now()->addHours($start_hour)->format('Y-m-d H:i:s'),Carbon::now()->addHours($end_hour)->subSecond()->format('Y-m-d H:i:s')];
        }

        if($type==='sub'){
            /* 8  > 2,1    > 6 7-1초 6.23.59.59 */
            return [Carbon::now()->subHours($start_hour)->subSecond()->format('Y-m-d H:i:s'),Carbon::now()->subHours($end_hour)->format('Y-m-d H:i:s')];
        }
        return false;
    }
    protected function ArrTimeReturn($start, $end, $type){
        if($type === 'add'){
            return [Carbon::now()->addMinutes($start)->format('Y-m-d H:i:s'),Carbon::now()->addMinutes($end)->subSecond()->format('Y-m-d H:i:s')];
        }

        if($type==='sub'){
            /* 8  > 2,1    > 6 7-1초 6.23.59.59 */
            return [Carbon::now()->subMinutes($start)->subSecond()->format('Y-m-d H:i:s'),Carbon::now()->subMinutes($end)->format('Y-m-d H:i:s')];
        }
        return false;
    }


    protected function failMailSend($id): void
    {
        $reservation = HotelReservation::find($id);
        if($reservation){
            $admins = [
                [
                    'email'=>'hotelmanager@travelmakers.kr',
                    'name'=>'정승재'
                ],
                [
                    'email'=>'travelmakerkorea_k@naver.com',
                    'name'=>'김병주'
                ]
            ];

            $data = [
                'ATCheck'=>false,
                'subject'=> '[호텔에삶/호텔/결제시도중팝업종료]'.$reservation->order_name . '님',
                'name'=>$reservation->order_name,
                'reservation' => $reservation,
                'hotel' => Hotel::whereId($reservation->hotel_id)->whereStatus('2')->first(),
                'room' => HotelRoom::whereId($reservation->room_id)->whereDisable('N')->first(),
                'curator' => Curator::whereId($reservation->curator_id)->whereVisible('1')->first(),
                'payment' => Payment::whereReservationId($reservation->id)->orderBy('id')->first(),
            ];

            foreach ($admins as $user){
                Mail::mailer('info')->send('emails.order_failed', $data, function($message) use ($user,$data) {
                    $message->to($user['email'],$user['name'])->subject($data['subject']);
                    $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                });
            }
        }

    }
}
