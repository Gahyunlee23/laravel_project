<?php

namespace App\Http\Livewire\Admin\Information\Generation\Reservation;

use App\AlertTalk;
use App\AlertTalkList;
use App\Confirmation;
use App\Curator;
use App\External;
use App\Formatter;
use App\Hotel;
use App\HotelOption;
use App\HotelReservation;
use App\HotelRoom;
use App\Payment;
use App\Rules\PhoneNumber;
use App\Template;
use App\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    public $paymentFormView = false;
    public $roomUpdate = false;
    public $confirmationFormView = false;

    public $hotel_reservation;
    public $reservation_id;
    public $reservationId;
    public $order_id;
    public $orderId;
    public $payment_id;
    public $reservation_box = false;

    public $hotel_id;
    public $room_id;

    public $rooms;
    public $select_room;
    public $reservation_type;

    public $order_desired_type='none_send';
    public $exit_dt_add;

    public $select_room_sale_price;

    public $order_name;
    public $order_email;
    public $order_hp;

    /* 동의*/
    public $use_terms = true;
    public $order_privacy = true;
    public $order_marketing;

    public $order_status;
    public $curator_id;

    public $room_type_id, $room_type_upgrade_id;
    public $room_type_index;
    public $room_options, $room_upgrades, $room_sold_out_lists;

    public $order_desired_dt;
    public $order_desired_time;
    public $start_dt1;
    public $start_dt2;
    public $end_dt1;
    public $end_dt2;

    public $order_price;
    public $order_sale_price;
    public $order_discount_rate;
    public $order_refund_amount;

    public $purpose;
    public $visit_route;

    protected $listeners = [
        'reservation_get_event' => 'reservation_get',
        'reset_form_event' => 'reset_form',
        'paymentFormShowEvent' => 'paymentFormShow',
        'paymentFormHideEvent' => 'paymentFormHide',
        'reRenderEvent'=>'reRender',
        'reMountEvent'=>'reMount',
    ];
    public $test_admins = [
        [
            'email' => 'zuiderzee@naver.com',
            'name' => '노한결'
        ]
    ];
    public $admins = [
        [
            'email'=>'hotelmanager@travelmakers.kr',
            'name'=>'정승재'
        ]
    ];

    public function mount()
    {
        if ($this->orderId !== null) {
            $this->order_id=$this->orderId;
        }
        if ($this->reservationId !== null) {
            $this->reservation_id=$this->reservationId;
        }
        if ($this->reservation_id !== null) {
            $this->reservation_get($this->order_id,$this->reservation_id);
        }
    }

    public function backRedirect()
    {
        return redirect()->intended('/admin/information');
    }

    public function rules(): array
    {
        return [
            'hotel_id' => ['required'],
            'order_name' => ['required'],
            'order_email' => ['required','email'],
            'order_hp' => ['required', new PhoneNumber()],
            'reservation_type' => ['required'],
            'use_terms' => ['required'],
            'order_privacy' => ['required'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function messages(): array
    {
        return [
            'hotel_id.required' => '호텔 선택 필수 사항입니다.',
            'order_name.required' => '성명 필수 사항입니다.',
            'order_email.required' => '이메일 필수 사항입니다.',
            'order_email.email' => '이메일 형식이 아닙니다.',
            'order_hp.required' => '연락처 필수 사항입니다.',
            'use_terms.required' => '이용약관 필수 사항입니다.',
            'order_privacy.required' => '개인정보활용 필수 사항입니다.',
        ];
    }

    public function reservation_get($order_id, $reservation_id): void
    {
        $this->reservation_box = true;
        $this->order_id = $order_id;
        $this->reservation_id = $reservation_id;

        $this->hotel_reservation = HotelReservation::find($reservation_id);
        $payment = Payment::whereReservationId($reservation_id)->first();
        if($payment){
            $this->payment_id=$payment->id;
        }
        $this->hotel_id = $this->hotel_reservation->hotel_id;
        $this->purpose = $this->hotel_reservation->purpose;
        $this->visit_route = $this->hotel_reservation->visit_route;

        $this->reservation_type = $this->hotel_reservation->type;

        $this->use_terms = $this->hotel_reservation->type;
        $this->order_privacy = $this->hotel_reservation->order_privacy;
        if ($this->hotel_reservation->order_marketing === 'N') {
            $this->order_marketing = false;
        } else {
            $this->order_marketing = true;
        }

        $this->order_name = $this->hotel_reservation->order_name;
        $this->order_email = $this->hotel_reservation->order_email;
        $this->order_hp = $this->hotel_reservation->order_hp;

        $this->order_desired_type = 'none_send';
        $this->order_status = $this->hotel_reservation->order_status;
        $this->curator_id = $this->hotel_reservation->curator_id;

        if ($this->hotel_reservation->type === 'tour') {
            $this->order_desired_dt = Carbon::parse($this->hotel_reservation->order_desired_dt)->format('Y-m-d');
            $this->order_desired_time = Carbon::parse($this->hotel_reservation->order_desired_dt)->format('H:i:s');
        } else if ($this->hotel_reservation->type === 'month') {
            $this->room_id = $this->hotel_reservation->room_id;
            //$this->room_type_id = $this->hotel_reservation->room_type_id;
            //$this->room_type_upgrade_id = $this->hotel_reservation->room_type_upgrade_id;

            $this->rooms = HotelRoom::whereHotelId($this->hotel_id)->whereDisable('N')->get();
            $this->select_room = HotelRoom::find($this->room_id);

            $this->start_dt1 = Carbon::parse($this->hotel_reservation->order_desired_dt)->format('Y-m-d');
            $this->start_dt2 = Carbon::parse($this->hotel_reservation->order_desired_dt)->addDays($this->select_room->nights ?? '')->format('H:i:s');
            $this->end_dt1 = Carbon::parse($this->hotel_reservation->order_desired_dt)->addDays($this->select_room->nights ?? '')->format('Y-m-d');
            $this->end_dt2 = Carbon::parse($this->hotel_reservation->order_desired_dt)->addDays($this->select_room->nights ?? '')->format('H:i:s');

            $this->room_select_setting();
        }
    }

    /* 주문생성 > 호텔 선택 */
    public function hotel_select_change(): void
    {
        if ($this->hotel_id !== '' && $this->hotel_id !== null) {
            $this->reservation_box = true;
            $this->rooms = HotelRoom::whereHotelId($this->hotel_id)->whereDisable('N')->get();
            $this->select_room = $this->rooms->first();
            $this->room_id = $this->select_room->id;
            if ($this->select_room) {
                $this->room_select_setting();
                $this->start_dt_change();
            }
        } else {
            $this->reservation_box = false;
        }
    }

    /* 주문생성 > 룸 선택 */
    public function room_select_change(): void
    {
        $this->select_room = HotelRoom::find($this->room_id);
//        $this->room_type_id='';
        if ($this->select_room) {
            $this->order_price = $this->select_room->price;
            $this->order_sale_price = $this->select_room->sale_price;
            $this->order_discount_rate = $this->select_room->discount_rate;
            $this->order_refund_amount = $this->select_room->refund_amount;
            if ($this->hotel_reservation) {
                $this->start_dt1 = Carbon::parse($this->hotel_reservation->order_desired_dt)->format('Y-m-d');
                $this->start_dt2 = Carbon::parse($this->hotel_reservation->order_desired_dt)->addDays($this->select_room->nights ?? '')->format('H:i:s');
                $this->end_dt1 = Carbon::parse($this->hotel_reservation->order_desired_dt)->addDays($this->select_room->nights ?? '')->format('Y-m-d');
                $this->end_dt2 = Carbon::parse($this->hotel_reservation->order_desired_dt)->addDays($this->select_room->nights)->format('H:i:s');
            }
            $this->room_select_setting();
            $this->start_dt_change();
        }
    }

    public function room_select_check(): void
    {
        $index = $this->room_options->search($this->room_type_id);
        $this->room_type_upgrade_id = '';
        if(isset($this->room_upgrades[$index]) && $this->room_upgrades[$index] !== null && $this->room_upgrades[$index] !== ''){
            $this->room_type_upgrade_id = $this->room_upgrades[$index];
        }
    }

    public function room_select_setting(): void
    {
        $this->room_type_upgrade_id = '';
        $this->room_type_id = '';
        if(isset($this->select_room)){
            $this->room_options       = Str::of($this->select_room->room_option)->explode(',')->filter(function ($item){ return $item ?? null; });
            $this->room_upgrades      = Str::of($this->select_room->room_upgrade)->explode(',')->filter(function ($item){ return $item ?? null; });
            $this->room_sold_out_lists = Str::of($this->select_room->room_sold_out)->explode(',')->filter(function ($item){ return $item ?? null; });
        }
    }

    public function start_dt_change(): void
    {
        if ($this->select_room) {
            $this->end_dt1 = Carbon::parse($this->start_dt1)->addDays($this->select_room->nights)->format('Y-m-d');
        }
    }

    public function reservation_type_change(): void
    {
        $this->order_desired_type='none_send';
        $this->order_status='';
        $this->rooms = HotelRoom::whereHotelId($this->hotel_id)->whereDisable('N')->get();

        $this->select_room = $this->rooms[0];
        $this->room_id = $this->rooms[0]->id;
        if($this->hotel_reservation){
            $this->start_dt1 = Carbon::parse($this->hotel_reservation->order_desired_dt)->format('Y-m-d');
            $this->start_dt2 = Carbon::parse($this->hotel_reservation->order_desired_dt)->format('H:i:s');
            $this->end_dt1 = Carbon::parse($this->start_dt1)->addDays($this->select_room->nights)->format('Y-m-d');
            $this->end_dt2 = Carbon::parse($this->start_dt1)->format('H:i:s');
        }
    }

    public function submit($formData)
    {
        $formatter = new Formatter();
        $result='fall';
        $alertTalkBool=false;
        if (isset($formData['use_terms'])) {
            $formData['use_terms'] = $formData['use_terms'] === 'on' ? 'Y' : 'N';
        } else {
            $formData['use_terms'] = 'N';
        }
        if (isset($formData['order_privacy'])) {
            $formData['order_privacy'] = $formData['order_privacy'] === 'on' ? 'Y' : 'N';
        } else {
            $formData['order_privacy'] = 'N';
        }
        if (isset($formData['order_marketing'])) {
            $formData['order_marketing'] = $formData['order_marketing'] === 'on' ? 'Y' : 'N';
        } else {
            $formData['order_marketing'] = 'N';
        }
        if (isset($this->select_room)) {
            $formData['order_price'] = $this->select_room->price;
            $formData['order_sale_price'] = $this->select_room->sale_price;
            $formData['order_discount_rate'] = $this->select_room->discount_rate;
            $formData['order_refund_amount'] = $this->select_room->refund_amount;
        }
        if (($formData['curator_id'] === '' || $formData['curator_id'] === null)) {
            $formData['curator_id'] = null;
        }
        if ($this->reservation_type === 'month') {
            $formData['order_desired_dt'] = Carbon::parse($formData['start_dt1'] . ' ' . $formData['start_dt2'])->format('Y-m-d H:i:s');
        } else if ($this->reservation_type === 'tour') {
            $formData['order_desired_dt'] = Carbon::parse($formData['order_desired_dt'] . ' ' . $formData['order_desired_time'])->format('Y-m-d H:i:s');
        }
        if($this->roomUpdate){
            if(!isset($this->room_type_id) || $this->room_type_id===''){
                $formData['room_type_id']=null;
                $formData['room_type_upgrade_id']=null;
            }
            if(!isset($this->room_type_upgrade_id) || $this->room_type_upgrade_id===''){
                $formData['room_type_upgrade_id']=null;
            }
        }else{
            unset($formData['room_id'], $formData['room_type_id'], $formData['room_type_upgrade_id']);
        }

        if(!isset($this->purpose) || $this->purpose===''){
            $formData['purpose']=null;
        }
        if(!isset($this->visit_route) || $this->visit_route===''){
            $formData['visit_route']=null;
        }

        $hotel_reservation = HotelReservation::updateOrCreate(
            [
                'id' => $formData['reservation_id']
            ],
            $formData
        );
        $this->reservation_id=$hotel_reservation->id;

        $outerSend='외부 전달 없이 저장완료';
        $result='save';

        if(User::whereEmail($hotel_reservation->order_email)->count() === 0){
            $user = User::create([
                'name'=>$hotel_reservation->order_name,
                'email'=>$hotel_reservation->order_email,
                'tel'=> Str::of(phone($hotel_reservation->order_hp,'KR'))->replace('+82','0')->replace('-',''),
                'phone'=>phone($hotel_reservation->order_hp,'KR'),
                'password'=> Hash::make(Str::of(phone($hotel_reservation->order_hp,'KR'))->replace('+82','0')->replace('-','')),
                'password_tmp'=> Str::of(phone($hotel_reservation->order_hp,'KR'))->replace('+82','0')->replace('-','')
            ]);
        }else{
            $user = User::whereEmail($hotel_reservation->order_email)->first();
        }
        if($user){
            $hotel_reservation->user_id=$user->id;
            $hotel_reservation->save();
        }

        switch ($this->order_status) {
            case '2' :
                if ($this->order_desired_type === 'hotel_send_tour') {
                    $outerSend='(호텔)투어 확정 필요 메일 전송';
                    $this->outerMailSend();
                }
                if ($this->order_desired_type === 'hotel_send_tour2') {
                    $outerSend='(호텔)투어 확정 필요 메일 전송';
                    $this->outerMailSend('변경');
                }
            break;
            case '5' :
                if ($this->order_desired_type === 'user_send') {
                    $desired_type='확정';
                    if ($this->reservation_type === 'tour') {
                        /* Confirmations 저장 처리 및 변경인지 확정인지 체크 후 전달 */
                        if($hotel_reservation){
                            $confirmation=Confirmation::firstWhere('reservation_id',$hotel_reservation->id);
                            if($confirmation){/*이미 확정된 정보가 있을경우*/
                                $desired_type='변경';
                                $result='success';
                                $confirmation->start_dt = Carbon::parse($this->order_desired_dt.' '.$this->order_desired_time)->format('Y-m-d H:i:s');
                                $confirmation->save();
                                $alertTalkBool=$this->alertTalkSend($hotel_reservation,$confirmation,'변경','투어 확정');
                            }else{/* 처음 확정 시*/
                                $result='success';
                                $confirmation=Confirmation::create([
                                    'reservation_id'=>$hotel_reservation->id,
                                    'start_dt'=>Carbon::parse($this->order_desired_dt.' '.$this->order_desired_time)->format('Y-m-d H:i:s'),
                                    'type'=>'HotelTour',
                                    'memo'=>$hotel_reservation->order_name.'님 투어 확정 완료',
                                    'status'=>'1',
                                ]);
                                $alertTalkBool=$this->alertTalkSend($hotel_reservation,$confirmation,'확정','투어 확정');
                            }

                            $outerSend=$formatter->carbonFormat(Carbon::parse($this->order_desired_dt.' '.$this->order_desired_time),'Y년 m월 d일(요일) H시 i분')
                                .' (고객) 투어 '.$desired_type.' + 알림톡 전달'.($alertTalkBool ? '완료':'실패' );
                        }else{
                            $outerSend='(고객) 투어 확정 오류 발생!!!';
                        }
                    }
                }

                break;
            case '0' : /* 취소 시 */
                $reservation = HotelReservation::find($this->reservation_id);

                if ($reservation->type === 'tour') {
                    if ($this->order_desired_type === 'cancel_user_send') {
                        $outerSend='취소처리 + 고객 알림톡 전송';
                        $alertTalkBool=$this->alertTalkSend($reservation,$reservation->confirmation,'취소','투어 취소');
                    }elseif ($this->order_desired_type === 'cancel_hotel_send') {
                        $outerSend='취소처리 + 호텔 관리자 메일 전달';
                        $this->outerMailSend('취소');
                    }elseif ($this->order_desired_type === 'cancel_user_hotel_send') {
                        $outerSend='취소처리 + 고객 알림톡 전송 + 호텔 관리자 메일 전달';
                        $alertTalkBool=$this->alertTalkSend($reservation,$reservation->confirmation,'취소','투어 취소');
                        $this->outerMailSend('취소');
                    }
                }
                if ($reservation->type === 'month') {
                    if ($this->order_desired_type === 'cancel_user_send') {
                        $outerSend='취소처리 + 고객 알림톡 전송';
                        $alertTalkBool=$this->alertTalkSend($reservation,$reservation->confirmation,'취소','주문 취소, 변경');
                    }elseif ($this->order_desired_type === 'cancel_hotel_send') {
                        $outerSend='취소처리 + 호텔 관리자 메일 전달';
                        $this->outerMailSend('취소');
                    }elseif ($this->order_desired_type === 'cancel_user_hotel_send') {
                        $outerSend='취소처리 + 고객 알림톡 전송 + 호텔 관리자 메일 전달';
                        $alertTalkBool=$this->alertTalkSend($reservation,$reservation->confirmation,'취소','주문 취소, 변경');
                        $this->outerMailSend('취소');
                    }
                }

                if($reservation->confirmation){
                    $outerSend.=' + 확정 취소 처리';
                    $reservation->confirmation->status=0;
                    $reservation->confirmation->save();
                }
                if($reservation->external){
                    $outerSend.=' + 확정 메일 비활정화';
                    $reservation->external->memo=$reservation->order_name.'님 '.$reservation->type.' 취소 처리';
                    $reservation->external->status=1;/*처리 완료 표기*/
                    $reservation->external->save();
                }
            break;
        }

        session(
            [
                'submit'=>[
                    'result'=>$result,
                    'resultMessage' => '저장 완료',
                    'outerSendResult'=>$outerSend,
                ]
            ]
        );
        $this->reRender();
    }

    public function reMount(): void
    {
        $this->mount();
    }

    public function reRender(): void
    {
        $this->emitSelf('render');
    }

    public function render()
    {
        return view('livewire.admin.information.generation.reservation.form');
    }



    public function paymentFormShow(): void
    {
        $this->paymentFormView=true;
    }

    public function paymentFormHide(): void
    {
        $this->paymentFormView=false;
    }

    public function alertTalkSend($reservation,$confirmation,$process='확정',$type='투어 확정'): bool
    {
        $hotel = Hotel::whereId($reservation->hotel_id)->whereStatus('2')->first();
        $hotel_option = HotelOption::whereHotelId($reservation->hotel_id)->whereDisable('N')->first();
        $hotel_room = HotelRoom::whereId($reservation->room_id)->first();
        $curator = Curator::whereId($reservation->curator_id)->whereVisible('1')->first();
        $payment = Payment::whereReservationId($reservation->id)->orderBy('id')->first();
        $formatter = new Formatter();
        if ($type === '투어 확정') {
            $template = Template::whereCatalog('투어 확정')->whereUse('1')->first();
            $template_content = $formatter->templateFormat($template->template, [
                '#{회원명}' => $reservation->order_name,
                '#{처리1}' => $process,
                '#{호텔명}' => $hotel_option->title,
                '#{호텔주소}' => $hotel_option->area,
                '#{투어확정일자}' => $formatter->carbonFormat(Carbon::parse($reservation->order_desired_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분')
            ]);
            $data = [
                'reserved_time' => '',/*예약시간*/
                're_send' => 'Y',
                'tel' => $formatter->hpFormat($reservation->order_hp),
                'template_code' => $template->code,
                'template' => $template_content
            ];
            $at = new AlertTalk($data);
            $at->send();

            AlertTalkList::create([
                'template_id'=>$template->id ?? null,
                'reservation_id'=>$reservation->id,
                'payment_id'=>$payment->id ?? null,
                'confirmation_id'=>$confirmation->id,
                'hotel_id'=>$reservation->hotel->id,
                'room_id'=>$hotel_room->id ?? null,
                'catalog'=>$template->catalog ?? null,
                'hp'=>$formatter->hpFormat($reservation->order_hp),
                'result'=>'success',
                'template'=>$template_content,
                'send_at'=>Carbon::now(),
            ]);

            $data = [
                'subject' => '[호텔에삶/호텔/투어'.$process.'완료]' . $reservation->order_name . '님',
                'name' => $reservation->order_name,
                'reservation' => $reservation,
                'hotel' => $hotel,
                'hotel_option' => $hotel_option,
                'curator' => $curator,
                'formatter'=> $formatter
            ];
            foreach ($this->admins as $index => $user) {
                Mail::mailer('info')->send('emails.outer.confirmation', $data, function ($message) use ($user, $data) {
                    $message->to($user['email'], $user['name'])->subject($data['subject']);
                    $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                });
            }

            $hotel_room = HotelRoom::whereId($reservation->room_id)->first();
            $external=External::create([
                'reservation_id'=>$reservation->id,
                'hotel_id'=>$reservation->hotel_id,
                'access_key'=>Str::random(60),
                'access_at'=> Carbon::now(),
                'access_end_at'=> Carbon::now()->addDays(3),
                'memo'=>$reservation->type.' 호텔관리자에게 전달',
                'type'=>'outer-order-completed',
                'status'=>'0'
            ]);
            $data = [
                'subject'=> '[호텔에삶]'.$reservation->order_name.'님 투어 '.$process.'되었습니다.',
                'type'=>$process,
                'name'=>$reservation->order_name,
                'reservation' => $reservation,
                'hotel' => $hotel,
                'hotel_option' => $hotel_option,
                'room' => $hotel_room,
                'payment' => $payment,
                'external'=>$external,
                'formatter'=> $formatter
            ];
            /*투어확정*/
            foreach ($hotel->tour_emails as $index => $email){
                Mail::mailer('hotel-manager')->send('emails.outer.order_completed_confirmation', $data, function($message) use ($email ,$data) {
                    $message->to($email, '호텔 관리자님')->subject($data['subject']);
                    $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'), env('HOTEL_MANAGER_MAIL_NICKNAME'));
                });
            }

            return true;
        }

        if($type==='투어 취소') {
            $template = Template::whereCatalog($type)->whereUse('1')->first();
            $template_content = $formatter->templateFormat($template->template, [
                '#{회원명}' => $reservation->order_name,
                '#{타입}' => '투어',
                '#{처리}' => $process
            ]);
            $data = [
                'reserved_time' => '',/*예약시간*/
                're_send' => 'Y',
                'tel' => $formatter->hpFormat($reservation->order_hp),
                'template_code' => $template->code,
                'template' => $template_content
            ];
            $at = new AlertTalk($data);
            $at->send();

            AlertTalkList::create([
                'template_id'=>$template->id ?? null,
                'reservation_id'=>$reservation->id,
                'payment_id'=>$payment->id ?? null,
                'confirmation_id'=>$reservation->confirmation->id ?? null,
                'hotel_id'=>$reservation->hotel->id ?? null,
                'room_id'=>$hotel_room->id ?? null,
                'catalog'=>$template->catalog ?? null,
                'hp'=>$formatter->hpFormat($reservation->order_hp),
                'result'=>'success',
                'template'=>$template_content,
                'send_at'=>Carbon::now(),
            ]);

            return true;
        }

        /* 입주 취소 처리 대응*/
        if($type==='주문 취소, 변경') {
            $template = Template::whereCatalog($type)->whereUse('1')->first();
            if(isset($reservation->confirmation) && $reservation->confirmation !== null ){
                $template_content = $formatter->templateFormat($template->template, [
                    '#{회원명}' => $reservation->order_name,
                    '#{타입}' => '입주',
                    '#{취소/변경}' => '취소',
                    '#{호텔명}' => $hotel_option->title,
                    '#{룸타입}' => $hotel_room->name,
                    '#{입주확정일자}' => $formatter->carbonFormat(Carbon::parse($reservation->confirmation->start_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분'),
                    '#{퇴실일자}' => $formatter->carbonFormat(Carbon::parse($reservation->confirmation->end_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분'),
                ]);
            }else{
                $template_content = $formatter->templateFormat($template->template, [
                    '#{회원명}' => $reservation->order_name,
                    '#{타입}' => '입주',
                    '#{취소/변경}' => '취소',
                    '#{호텔명}' => $hotel_option->title,
                    '#{룸타입}' => $hotel_room->name,
                    '#{입주확정일자}' => $formatter->carbonFormat(Carbon::parse($reservation->order_desired_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분'),
                    '#{퇴실일자}' => $formatter->carbonFormat(Carbon::parse($reservation->order_desired_dt)->addDays($hotel_room->nights)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분'),
                ]);
            }

            $data = [
                'reserved_time' => '',/*예약시간*/
                're_send' => 'Y',
                'tel' => $formatter->hpFormat($reservation->order_hp),
                'template_code' => $template->code,
                'template' => $template_content
            ];
            $at = new AlertTalk($data);
            $at->send();

            AlertTalkList::create([
                'template_id'=>$template->id ?? null,
                'reservation_id'=>$reservation->id,
                'payment_id'=>$payment->id ?? null,
                'confirmation_id'=>$reservation->confirmation->id ?? null,
                'hotel_id'=>$reservation->hotel->id ?? null,
                'room_id'=>$hotel_room->id ?? null,
                'catalog'=>$template->catalog ?? null,
                'hp'=>$formatter->hpFormat($reservation->order_hp),
                'result'=>'success',
                'template'=>$template_content,
                'send_at'=>Carbon::now(),
            ]);
            return true;
        }

    }


    protected function outerMailSend ($type='확정'): void
    {
        $reservation = HotelReservation::find($this->reservation_id);
        if($reservation->type === 'tour' && $type !== '취소'){
            if($reservation){
                External::whereReservationId($reservation->id)->whereHotelId($reservation->hotel_id)
                    ->whereStatus(0)->whereMemo($reservation->type.' 호텔관리자에게 전달')
                    ->update(['status'=>1]);
                $external=External::create([
                    'reservation_id'=>$reservation->id,
                    'hotel_id'=>$reservation->hotel_id,
                    'access_key'=>Str::random(60),
                    'access_at'=> Carbon::now(),
                    'access_end_at'=> Carbon::now()->addDays(3),
                    'memo'=>$reservation->type.' 호텔관리자에게 전달',
                    'type'=>'outer-order-completed',
                    'status'=>'0'
                ]);

                if($external){
                    $hotel_room = HotelRoom::whereId($reservation->room_id)->first();
                    $hotel = Hotel::whereId($reservation->hotel_id)->first();
                    $data = [
                        'subject'=> '[호텔에삶]'.$reservation->order_name.'님 투어 '.$type.' 신청되었습니다.',
                        'type'=>$type,
                        'name'=>$reservation->order_name,
                        'reservation' => $reservation,
                        'hotel' => $hotel,
                        'hotel_option' => HotelOption::whereHotelId($reservation->hotel_id)->whereDisable('N')->first(),
                        'room' => $hotel_room,
                        'curator' => Curator::whereId($reservation->curator_id)->whereVisible('1')->first(),
                        'payment' => Payment::whereReservationId($reservation->id)->orderBy('id')->first(),
                        'external'=>$external,
                        'formatter'=> new Formatter()
                    ];

                    if(auth()->check() && auth()->user()->hasAnyRole('개발')) {
                        foreach ($hotel->admin_emails as $index => $email) {
                            Mail::mailer('info')->send('emails.outer.order_completed', $data, function($message) use ($data, $email) {
                                $message->to($email, '호텔 관리자님')->subject($data['subject']);
                                $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                            });
                        }
                    }else{
                        foreach ($hotel->tour_emails as $index => $email){
                            Mail::mailer('hotel-manager')->send('emails.outer.order_completed', $data, function($message) use ($data, $email) {
                                $message->to($email, '호텔 관리자님')->subject($data['subject']);
                                $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'), env('HOTEL_MANAGER_MAIL_NICKNAME'));
                            });
                        }
                    }
//                    $admins = [
//                        'hotelmanager@travelmakers.kr'
//                    ];
//                    foreach ($admins as $index => $email){
//                        Mail::mailer('hotel-manager')->send('emails.outer.order_completed', $data, function($message) use ($email,$data) {
//                            $message->to($email, '트래블메이커 관리자님')->subject($data['subject']);
//                            $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'), env('HOTEL_MANAGER_MAIL_NICKNAME'));
//                        });
//                    }
                }
            }
        }

        if($type === '취소'){
            $reservationType = $reservation->type === 'tour' ? '투어' : '입주';
            $subject='[호텔에삶]'.$reservation->order_name.'님 '.$reservationType.' 취소되었습니다.';
            $data = [
                'reservation' => $reservation,
                'formatter'=> new Formatter()
            ];
            $admins = [
                'hotelmanager@travelmakers.kr'
            ];
            if($reservation->type === 'tour'){
                foreach ($reservation->hotel->tour_emails as $index => $email){
                    Mail::mailer('hotel-manager')->send('emails.outer.cancel', $data, function($message) use ($subject, $email) {
                        $message->to($email, '호텔 관리자님')->subject($subject);
                        $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'), env('HOTEL_MANAGER_MAIL_NICKNAME'));
                    });
                }
            }elseif($reservation->type === 'month'){
                foreach ($reservation->hotel->living_emails as $index => $email){
                    Mail::mailer('hotel-manager')->send('emails.outer.cancel', $data, function($message) use ($subject, $email) {
                        $message->to($email, '호텔 관리자님')->subject($subject);
                        $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'), env('HOTEL_MANAGER_MAIL_NICKNAME'));
                    });
                }
            }
            foreach ($admins as $index => $email){
                Mail::mailer('info')->send('emails.outer.cancel', $data, function($message) use ($email, $subject) {
                    $message->to($email, '트래블메이커 관리자님')->subject($subject);
                    $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                });
            }
        }



    }
}
