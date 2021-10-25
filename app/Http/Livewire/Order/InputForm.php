<?php

namespace App\Http\Livewire\Order;

use App\AlertTalk;
use App\AlertTalkList;
use App\CertifiedKey;
use App\Curator;
use App\External;
use App\Formatter;
use App\Hotel;
use App\HotelOption;
use App\HotelReservation;
use App\HotelRoom;
use App\Payment;
use App\PeriodPrice;
use App\Template;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class InputForm extends Component
{
    /* Request */
    public $hotel;
    public $reservation;

    /* 입주 목적 */
    public $purposes = ['인테리어','여행','이사','출장','기타'];
    public $purpose;
    public $purpose_value;

    /* 방문  경로 */
    public $visit_routes = ['네이버', 'SNS', '카카오톡', '커뮤니티/카페', '지인추천', '기타'];
    public $visit_route;
    public $visit_route_value;

    /* 동의 부분 */
    public $all_check=false;
    public $operating_terms=false;
    public $privacy=false;
    public $marketing=false;

    /* Input */
    public $order_name;

    public $countryCode;
    public $order_hp;
    public $tel;

    public $order_email;
    public $start_date, $end_date;
    /* 가능 기간 uniq */
    public $period_prices;
    /* 선택 기간 의 가격 get */
    public $periodPrices;

    public $periodCarbonDateArr;
    /* 선택 중인 룸 타입 */
    public $selectRoom;
    /* 선택 중인 룸의 선택 기간에 대한 판매 가격*/
    public $real_sale_price;

    /* 투어 */
    public $order_desired_dt;
    public $time_hour;
    public $time_minute;

    protected $listeners =[
        'HandPhoneSendEmit',
        'CalendarDateClick'=>'dateClick',
        'CalendarDateClear'=>'dateClear',
        'CalendarPossibleRoomType'=>'possibleRoomType',
    ];

    public function mount(){
        if($this->reservation->type === 'month'){
            $this->period_prices=array_values(Arr::sort(array_unique($this->hotel->period_prices()
                ->where('type', '=', 'price')->pluck('range_d')->toArray()), function ($value) {
                return $value;
            }));
        }else{
            $this->period_prices=array_values(Arr::sort(array_unique($this->hotel->period_prices()
                ->where('type', '=', 'tour')->pluck('range_d')->toArray()), function ($value) {
                return $value;
            }));
        }
        if(auth()->check()){
            $this->order_name = auth()->user()->name;
            $this->order_hp = auth()->user()->tel;
            $this->order_email = auth()->user()->email;
        }
    }

    public function dateClear(){
        $this->start_date = null;
        $this->end_date = null;
    }

    public function dateClick($date){
        if($this->reservation->type === 'month'){
            if($this->start_date === null){
                $this->start_date = $date;
                $this->emitTo('order.calendar', 'calendarDateCheck', ['start_date'=>$this->start_date,'end_date'=>$this->end_date]);
            }elseif($this->end_date === null) {
                if($this->start_date > $date){
                    $this->end_date = $this->start_date;
                    $this->start_date = $date;
                }else if($this->start_date === $date){
                    $this->start_date = $date;
                }else{
                    $this->end_date = $date;
                }
                $this->emitTo('order.calendar', 'calendarDateCheck', ['start_date'=>$this->start_date,'end_date'=>$this->end_date]);

                $periodCarbonDates = CarbonPeriod::create(Carbon::parse($this->start_date), Carbon::parse($this->end_date));
                $this->periodCarbonDateArr = [];
                foreach ($periodCarbonDates as $item){
                    $this->periodCarbonDateArr[]=$item->format('Y-m-d');
                }
                /* 기본 룸 타입 세팅 */
                $this->selectRoom=PeriodPrice::where('hotel_id', '=', $this->hotel->id)
                        ->where('type', '=', 'price')
                        ->where('date', '<=', collect($this->periodCarbonDateArr)->count())
                        ->whereIn('range_d', $this->periodCarbonDateArr)
                        ->orderBy('room_type_id')
                        ->groupBy('room_type_name')->first()->room_type_name ?? '';
            }else{
                $this->emitTo('order.calendar', 'calendarDateClear');
                $this->start_date = $date;
                $this->end_date = null;
            }
        }elseif($this->reservation->type === 'tour'){
            $this->start_date = $date;
            $this->emitTo('order.calendar', 'calendarDateCheck', ['start_date'=>$this->start_date]);
        }
    }

    public function possibleRoomType()
    {
        $periodDates = CarbonPeriod::create($this->start_date, $this->end_date); // 선택 기간
        /*$selectDates=null;
        foreach ($periodDates aS $periodDate){
            $selectDates[]=$periodDate->format('Y-m-d');
        }*/
        $this->periodPrices = PeriodPrice::whereType('price')->whereHotelId($this->hotel->id)
            ->where('type', '=', 'price')
            ->where('date', '<=', $periodDates->count())
            ->whereBetween('range_d', [$this->start_date, $this->end_date])
            ->where('room_type_name', '=', $this->selectRoom)
            ->orderBy('date', 'DESC')
            ->get();
        $this->periodPrices = collect($this->periodPrices)->groupBy('range_d');
        if($this->periodPrices->count() > 0){
            $this->real_sale_price = $this->periodPrices->sortKeys()->sum('0.sale_price');
        }
    }

    public function checkBoxObserver($target): void
    {
        if($target === 'all_check'){
            if($this->{$target}){
                $this->operating_terms = true;
                $this->privacy = true;
                $this->marketing = true;
            }else{
                $this->operating_terms = false;
                $this->privacy = false;
                $this->marketing = false;
            }
        }else{
            if(!$this->{$target}){
                $this->all_check = false;
            }
            if($this->operating_terms&&$this->privacy&&$this->marketing){
                $this->all_check = true;
            }
        }
    }

    public function HandPhoneSendEmit($data)
    {
        if($data['certified_key_completed']){
            $this->countryCode = $data['countryCode'];
            $this->tel = $data['tel'];
        }
    }

    public function submit()
    {
        $this->resetErrorBag();
        if($this->reservation->type === 'month'){
            $validate = $this->validate([
                'order_name' => ['required'],
                'tel'=>['required', 'phone:KR,US'],
                'order_email'=>['required', 'email'],

                'start_date'=>['required'],
                'end_date'=>['required','after:start_date'],
                'real_sale_price'=>['required'],

                'purpose'=>['required'],
                'purpose_value'=>[''],
                'visit_route'=>['required'],
                'visit_route_value'=>[''],

                'operating_terms' => ['accepted'],
                'privacy' => ['accepted'],
                'marketing' => [],
            ],[
                'order_name.required'=>'주문자 명 필수 입력입니다',

                'tel.required'=>'휴대전화 번호 필수 인증입니다',
                'tel.phone'=>'인증 가능 국가는 한국,미국 입니다',

                'order_email.required'=>'이메일 필수 입력입니다',
                'order_email.email'=>'이메일 형식이 아닙니다',

                'start_date.required'=>'입주 기간은 필수 선택입니다',
                'end_date.required'=>'퇴실 기간은 필수 선택입니다',
                'end_date.after'=>'퇴실 기간은 입주 기간 이후 입니다',
                'real_sale_price.required'=>'기간 선택 및 룸 선택 후 최종 가격 확인해주세요',

                'purpose.required'=>'입주 목적은 필수 선택입니다.',
                'visit_route.required'=>'방문 경로는 필수 선택입니다.',

                'operating_terms.accepted'=>'이용약관 및 취소환불 규정은 필수 동의입니다',
                'privacy.accepted'=>'개인정보 수집 및 활용은 필수 동의입니다',
            ]);
        }else{

            $validate = $this->validate([
                'order_name' => ['required'],
                'tel'=>['required', 'phone:KR,US'],
                'order_email'=>['required', 'email'],

                'start_date'=>['required'],
                'time_hour'=>['required'],
                'time_minute'=>['required'],

                'purpose'=>['required'],
                'purpose_value'=>[''],
                'visit_route'=>['required'],
                'visit_route_value'=>[''],

                'operating_terms' => ['accepted'],
                'privacy' => ['accepted'],
                'marketing' => [],
            ],[
                'order_name.required'=>'주문자 명 필수 입력입니다',

                'tel.required'=>'휴대전화 번호 필수 인증입니다',
                'tel.phone'=>'인증 가능 국가는 한국,미국 입니다',

                'order_email.required'=>'이메일 필수 입력입니다',
                'order_email.email'=>'이메일 형식이 아닙니다',

                'start_date.required'=>'투어 희망 날짜는 필수 선택입니다',
                'time_hour.required'=>'투어 희망 시간은 필수 선택입니다',
                'time_minute.required'=>'투어 희망 시간은 필수 선택입니다',

                'purpose.required'=>'입주 목적은 필수 선택입니다.',
                'visit_route.required'=>'방문 경로는 필수 선택입니다.',

                'operating_terms.accepted'=>'이용약관 및 취소환불 규정은 필수 동의입니다',
                'privacy.accepted'=>'개인정보 수집 및 활용은 필수 동의입니다',
            ]);
        }
        $user = null;
        if(auth()->check()){
            $user = auth()->user();
        }else{
            $user = User::create([
                'name'=>$validate['order_name'],
                'email'=>$validate['order_email'],

                'country_code'=>$this->countryCode ?? '+82',
                'tel'=> Str::of(phone($validate['tel'],'KR'))->replace('+82','0')->replace('-',''),
                'phone'=>phone($validate['tel'],'KR'),
                /*        'tel'=>$validate['tel'],
                       'phone'=>'+'.phone($validate['tel'],'KR')->getPhoneNumberInstance()->getCountryCode().phone($validate['tel'],'KR')->getPhoneNumberInstance()->getNationalNumber(),
                      'password'=>Hash::make($validate['tel']),
                       'password_tmp'=>$validate['tel'],*/
                'password'=> Hash::make(Str::of(phone($validate['tel'],'KR'))->replace('+82','0')->replace('-','')),
                'password_tmp'=> Str::of(phone($validate['tel'],'KR'))->replace('+82','0')->replace('-',''),
                'marketing'=>$validate['marketing'] === true ? '1' : '0'
            ]);
        }
        if($user !== null){
            $this->reservation->user_id = $user->id;
        }
        if($validate['purpose'] === '기타'){
            $validate['purpose'] = $validate['purpose'].':'.$validate['purpose_value'];
        }
        if($validate['visit_route'] === '기타'){
            $validate['visit_route'] = $validate['visit_route'].':'.$validate['visit_route_value'];
        }
        $this->reservation->order_name=$validate['order_name'];
        $this->reservation->order_hp=$validate['tel'];
        $this->reservation->country_code=$this->countryCode ?? '+82';
        $this->reservation->order_email=$validate['order_email'];

        $this->reservation->use_terms=$validate['operating_terms'];
        $this->reservation->order_privacy=$validate['privacy'];
        $this->reservation->order_marketing=$validate['marketing'];

        $this->reservation->purpose=$validate['purpose'];
        $this->reservation->visit_route=$validate['visit_route'];

        if($this->reservation->type === 'month'){
            $this->reservation->order_price=$this->periodPrices->sortKeys()->sum('0.price');
            $this->reservation->order_sale_price=$validate['real_sale_price'];

            if($this->periodPrices->sortKeys()->max('0.discount') > 100){
                $this->reservation->order_discount_rate=$this->periodPrices->sortKeys()->sum('0.discount');
            }else{
                $this->reservation->order_discount_rate=$this->periodPrices->sortKeys()->max('0.discount');
            }
            $this->reservation->order_refund_amount=$this->periodPrices->sortKeys()->sum('0.refund');

            $this->reservation->order_desired_dt=$validate['start_date'];

            $roomCheck = PeriodPrice::where('hotel_id', '=', $this->hotel->id)
                ->where('type', '=', 'price')
                ->whereBetween('range_d', [$this->start_date, $this->end_date])
                ->where('room_type_name', '=', $this->selectRoom)->first();
            $this->reservation->room_type_id=$roomCheck->room_type_id ?? null;

            if($this->periodPrices->sortKeys()->sum('0.sale_price')===$validate['real_sale_price']){
                $this->reservation->order_status='2';
            }else{
                $this->reservation->order_status='8';
                $this->addError('price_error', '결제금이 일치하지 않습니다, 새로 고침후 시도해주세요');
            }
            $periodDates = CarbonPeriod::create($this->start_date, $this->end_date);

            $days = $periodDates->count();
            $nights = ($days-1);

            $room = HotelRoom::create([
                'hotel_id'=>$this->hotel->id,
                'user_id'=>$user->id,
                'name'=>$this->selectRoom,
                'title'=>$this->selectRoom.' '.$nights.'박 '.$days.'일' ,
                'nights'=>$nights,
                'days'=>$days,
                'price'=>$this->reservation->order_price,
                'sale_price'=>$this->reservation->order_sale_price,
                'discount_rate'=>$this->reservation->order_discount_rate,
                'refund_amount'=>$this->reservation->order_refund_amount,
                'main_explanation'=>$this->selectRoom,
            ]);
            if($room){
                $this->reservation->room_id=$room->id;
                $this->reservation->save();
                return redirect()->to(route("payment.order", ['method'=>'card', 'reservation'=>$this->reservation->id]));
            }
            $this->addError('price_error', '룸 옵션이 올바르지 않습니다, 새로 고침후 시도해주세요');
        }else{
            if($this->reservation){
                if ($this->reservation->order_status !== '3') {
                    $this->reservation->order_status='2';
                }
                if($this->time_hour !== null && $this->time_minute !== null){
                    $this->reservation->order_desired_dt = Carbon::parse(($validate['start_date'].' '.($this->time_hour).':'.$this->time_minute.':00'))->format('Y-m-d H:i:s');
                }else{
                    $this->reservation->order_desired_dt=$validate['start_date'];
                }

                $this->reservation->save();
                /* 투어 신청 완료 처리*/
                if($this->reservation->id!=='' && $this->reservation->id!==null){
                    $ATCheck=$this->reservationByIdToAT($this->reservation->id, 'tour_order_completed');
                    $outerCheck=$this->outerMailSend($this->reservation->id);
                    $this->mailSend($this->reservation->id, $ATCheck, $outerCheck);
                }
            }
            return redirect()->to(route("reservations.completed"));
        }

        //ddd($validate,$user,$this->reservation,$this->periodPrices->sortKeys()->sum('0.price'));
    }

    public function updated()
    {
        $this->resetErrorBag();
    }

    protected function reservationByIdToAT($reservation_id, $type): ?bool
    {
        $formatter = new Formatter();
        if($this->reservation){
            $hotel_option= HotelOption::whereHotelId($this->reservation->hotel_id)->whereDisable('N')->first();
            if($hotel_option && $type === 'tour_order_completed') {
                $template=Template::whereCatalog('투어 신청 완료')->whereUse('1')->first();
                $template_content = $formatter->templateFormat($template->template, [
                    '#{호텔명}' => $hotel_option->title,
                    '#{투어희망일자}' =>$formatter->carbonFormat(Carbon::parse($this->reservation->order_desired_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분')
                ]);

                $data = [
                    'reserved_time'=>'',/*예약시간*/
                    're_send'=>'Y',
                    'tel' => $formatter->hpFormat($this->reservation->order_hp),
                    'template_code' => $template->code,
                    'template' => $template_content
                ];

                $at = new AlertTalk($data);
                $at->send();

                AlertTalkList::create([
                    'template_id'=>$template->id,
                    'reservation_id'=>$this->reservation->id,
                    'hotel_id'=>$this->reservation->hotel->id,
                    'catalog'=>$template->catalog,
                    'hp'=>$formatter->hpFormat($this->reservation->order_hp),
                    'result'=>'success',
                    'template'=>$template_content,
                    'send_at'=>Carbon::now(),
                ]);
                return true;
            }
        }
        return false;
    }


    protected function mailSend($id, $ATCheck, $outerCheck): void
    {
        $admins = [
            [
                'email'=>'hotelmanager@travelmakers.kr',
                'name'=>'정승재'
            ]
        ];

        if($this->reservation){
            $subject='[호텔에삶/투어/신청완료]'.$this->reservation->order_name . '님';

            $data = [
                'ATCheck'=>$ATCheck,
                'outerCheck'=>$outerCheck,
                'subject'=> $subject,
                'name'=>$this->reservation->order_name,
                'reservation' => $this->reservation,
                'hotel' => Hotel::whereId($this->reservation->hotel_id)->whereStatus('2')->first(),
                'room' => HotelRoom::whereId($this->reservation->room_id)->whereDisable('N')->first(),
                'curator' => Curator::whereId($this->reservation->curator_id)->whereVisible('1')->first(),
                'payment' => Payment::whereReservationId($this->reservation->id)->orderBy('id')->first(),
            ];

            foreach ($admins as $index => $user){
                Mail::mailer('info')->send('emails.order_completed', $data, function($message) use ($user,$data) {
                    $message->to($user['email'],$user['name'])->subject($data['subject']);
                    $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                });
            }
        }
    }


    protected function outerMailSend ($id)
    {
        if($this->reservation){
            $external=External::create([
                'reservation_id'=>$this->reservation->id,
                'hotel_id'=>$this->reservation->hotel_id,
                'access_key'=>Str::random(60),
                'access_at'=> Carbon::now(),
                'access_end_at'=> Carbon::now()->addDays(3),
                'memo'=>$this->reservation->type.' 호텔관리자에게 전달',
                'type'=>'outer-order-completed',
                'status'=>'0'
            ]);

            if($external){
                $hotel_room = HotelRoom::whereId($this->reservation->room_id)->first();
                $hotel = Hotel::whereId($this->reservation->hotel_id)->first();
                $data = [
                    'subject'=> '[호텔에삶] 호텔 투어 신청이 들어왔습니다.',
                    'name'=>$this->reservation->order_name,
                    'reservation' => $this->reservation,
                    'hotel' => $hotel,
                    'hotel_option' => HotelOption::whereHotelId($this->reservation->hotel_id)->whereDisable('N')->first(),
                    'room' => $hotel_room,
                    'curator' => Curator::whereId($this->reservation->curator_id)->whereVisible('1')->first(),
                    'payment' => Payment::whereReservationId($this->reservation->id)->orderBy('id')->first(),
                    'external'=>$external,
                    'formatter'=> new Formatter()
                ];
                $sendMail='';
                if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                    foreach ($hotel->admin_emails as $index => $email){
                        Mail::mailer('info')->send('emails.outer.order_completed', $data, function($message) use ($data, $email) {
                            $message->to($email, '호텔 관리자님')->subject($data['subject']);
                            $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                        });
                    }
                    $sendMail=$hotel->admin_emails;
                }else{
                    foreach ($hotel->tour_emails as $index => $email){
                        Mail::mailer('hotel-manager')->send('emails.outer.order_completed', $data, function($message) use ($data, $email) {
                            $message->to($email, '호텔 관리자님')->subject($data['subject']);
                            $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'),env('HOTEL_MANAGER_MANAGER_MAIL_NICKNAME'));
                        });
                    }
                    $sendMail=$hotel->tour_emails;
                }
                return $sendMail;
            }
        }
    }


	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.order.input-form');
	}
}
