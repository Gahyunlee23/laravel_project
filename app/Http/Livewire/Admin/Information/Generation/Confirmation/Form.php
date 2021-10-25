<?php

namespace App\Http\Livewire\Admin\Information\Generation\Confirmation;

use App\AlertTalk;
use App\AlertTalkList;
use App\Confirmation;
use App\Curator;
use App\External;
use App\Formatter;
use App\Hotel;
use App\HotelReservation;
use App\HotelRoom;
use App\Rules\PhoneNumber;
use App\Settlement;
use App\Template;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    protected $listeners = [
        'reservationTypeChangeEvent' => 'reservationTypeChange',
        'reRenderEvent' => 'confirmationFormReRender',
        'confirmationReDataLoadEvent' => 'dataLoad'
    ];

    public $reservation_id;

    public $confirmation;
    public $confirmationCheck=false;
    public $reservation;
    public $payment;
    public $alertTalkList;

    public $process='none';

    public function mount(){
        $this->dataLoad();
    }

    public function dataLoad(){
        if($this->reservation_id){
            $confirmation=Confirmation::whereReservationId($this->reservation_id)->latest()->first();
            $this->reservation=HotelReservation::find($this->reservation_id);
            if($confirmation){
                $this->confirmationCheck=true;
                $this->confirmation = ($confirmation)->toArray();
                if($this->confirmation['start_dt']){
                    $this->confirmation['start_dt1']=Carbon::parse($this->confirmation['start_dt'])->format('Y-m-d');
                    $this->confirmation['start_dt2']=Carbon::parse($this->confirmation['start_dt'])->format('H:i');
                    $this->confirmation['end_dt1']=Carbon::parse($this->confirmation['end_dt'])->format('Y-m-d');
                    $this->confirmation['end_dt2']=Carbon::parse($this->confirmation['end_dt'])->format('H:i');
                }
                if($this->reservation->payments->count() >= 1){
                    $this->alertTalkList=AlertTalkList::whereConfirmationId($this->confirmation['id'])->wherePaymentId($this->reservation->payments->last()->id)->whereReservationId($this->reservation->id)->get();
                }
            }elseif($this->reservation && $this->reservation->type ==='month'){
                $this->confirmation['room_type']=$this->reservation->room->main_explanation ?? '';
                $this->confirmation['start_dt1']=Carbon::parse($this->reservation->order_desired_dt)->format('Y-m-d');
                $this->confirmation['start_dt2']=Carbon::parse($this->reservation->order_desired_dt)->setHours(14)->format('H:i');
                if($this->reservation->room){
                    $this->confirmation['end_dt1']=Carbon::parse($this->reservation->order_desired_dt)->addDays($this->reservation->room->nights)->format('Y-m-d');
                    $this->confirmation['end_dt2']=Carbon::parse($this->reservation->order_desired_dt)->addDays($this->reservation->room->nights)->setHours(12)->format('H:i');
                }
                $this->confirmation['status']=1;
            }

            $this->confirmation['reservation_id']=$this->reservation_id;
            if($this->reservation->payments->count()>=1){
                $this->confirmation['payment_id']=$this->reservation->payments->last()->id;
            }

        }
        $this->confirmation['add_day']=0;
        $this->confirmation['add_day_schedule']=0;
    }

    public function rules(): array
    {
        return [
            'confirmation.reservation_id' => ['required','numeric'],
            'confirmation.payment_id' => ['required','numeric'],
            'confirmation.room_type' => ['required'],
            'confirmation.start_dt1' => ['required','date'],
            'confirmation.start_dt2' => ['required','date_format:"H:i"'],
            'confirmation.end_dt1' => ['required','date','after:confirmation.start_dt1'],
            'confirmation.end_dt2' => ['required','date_format:"H:i"'],
            'confirmation.add_day' => [''],
            'confirmation.add_days' => [''],
            'confirmation.status' => [''],
            'confirmation.memo' => [''],
            'confirmation.add_memo' => [''],
        ];
    }

    public function updated($propertyName): void
    {
        if($propertyName === 'confirmation.add_day' && $this->confirmation['add_day'] >= 0){
            $this->confirmation['end_dt1']=Carbon::parse($this->confirmation['start_dt1'])->addDays(($this->reservation->room->nights ?? 0) + ($this->confirmation['add_day'] ?? 0) + ($this->confirmation['add_days'] ?? 0))->format('Y-m-d');
            //$this->confirmation['end_dt2']=Carbon::parse($this->confirmation['start_dt1'])->addDays($this->reservation->room->nights + ($this->confirmation['add_day'] ?? 0) + ($this->confirmation['add_days'] ?? 0))->format('H:i');
            $this->validateOnly($propertyName);
        }elseif($propertyName === 'process' && ($this->process ==='호텔관리자_입주연장_문의' || $this->process ==='호텔관리자_입주변경_문의')){
            $this->confirmation['status'] = 0;
        }else{
            $this->validateOnly($propertyName);
        }
    }

    public function messages(): array
    {
        return [
            'confirmation.reservation_id.required' => '주문정보 필수 사항입니다.',
            'confirmation.reservation_id.numeric' => '주문정보 확인 후 진행해주세요.',

            'confirmation.payment_id.required' => '결제정보 필수 사항입니다.',
            'confirmation.payment_id.numeric' => '결제정보 확인 후 진행해주세요.',

            'confirmation.room_type.required' => '확정룸타입 필수 사항입니다.',

            'confirmation.start_dt1.required' => '입주일 필수 사항입니다.',
            'confirmation.start_dt1.date' => '입주일 날짜만 입력가능합니다.',
            'confirmation.start_dt2.required' => '입주시간 필수 사항입니다.',
            'confirmation.start_dt2.date_format' => '입주시간 시간만 입력가능합니다.',

            'confirmation.end_dt1.after' => '퇴실일은 입주일 보다 이후 만 됩니다.',
            'confirmation.end_dt1.required' => '퇴실일 필수 사항입니다.',
            'confirmation.end_dt1.date' => '퇴실일 날짜만 입력가능합니다.',
            'confirmation.end_dt2.required' => '퇴실시간 필수 사항입니다.',
            'confirmation.end_dt2.date_format' => '퇴실시간 시간만 입력가능합니다.',
        ];
    }

    public function confirmationSubmit(): void
    {
        $formatter = new Formatter();
        $outerSend='확정 정보 저장완료';
        $result='save';
        $formData = $this->validate($this->rules())['confirmation'];

        $formData['add_days'] = ($formData['add_days'] ?? 0) + ($formData['add_day'] ?? 0);
        $formData['add_days_schedule'] = ($formData['add_days_schedule'] ?? 0) + ($formData['add_day_schedule'] ?? 0);
        $formData['type'] = 'LivingInHotel';

        if($formData['add_day'] >=1){
            if(isset($formData['add_memo'])&&$formData['add_memo']!==null){
                $formData['add_memo'] .='
                '.Carbon::now()->format('Ymd H:i:s').' +'.$formData['add_day'].'일 추가 되었습니다.';
            }else{
                $formData['add_memo'] = Carbon::now()->format('Ymd H:i:s').' +'.$formData['add_day'].'일 추가 되었습니다.';
            }
        }

        if(isset($formData['start_dt1']) && isset($formData['start_dt2'])){
            $formData['start_dt']= $formData['start_dt1'].' '.($formData['start_dt2'].':00');
        }
        if(isset($formData['end_dt1']) && isset($formData['end_dt2'])){
            $formData['end_dt']= $formData['end_dt1'].' '.($formData['end_dt2'].':00');
        }

        if($formData['status'] === '2'){
            $hotelReservation=HotelReservation::find($this->reservation->id);
            $hotelReservation->order_status = '11';
            $hotelReservation->save();
            $formData['status']='0';
        }
        if(auth()->check()){
            $formData['user_id']=auth()->user()->id;
        }
        /*if(auth()->check() && auth()->user()->hasAnyRole('개발')){*/
        if($formData['reservation_id']!==null){
            Confirmation::where('reservation_id', '=', $formData['reservation_id'])
                ->where('status', '=', '1')
                ->update([
                'status'=>'0'
            ]);
        }
        $confirmation=Confirmation::Create(
            $formData
        );
        /*}else{
            if(isset($this->confirmation['id'])){
                $confirmation=Confirmation::updateOrCreate(
                    [
                        'id'=>$this->confirmation['id']
                    ],
                    $formData
                );
            }else{
                $confirmation=Confirmation::Create(
                    $formData
                );
            }
        }*/

        if($confirmation){
            switch ($this->process) {
                case '고객_입주확정_알림톡':
                    $result='success';
                    $outerSend='입주 확정 + 고객 알림톡 전송';
                    if($this->reservation){
                        External::create([
                            'reservation_id'=>$this->reservation->id,
                            'hotel_id'=>$this->reservation->hotel_id,
                            'access_key'=>Str::random(60),
                            'access_at'=> Carbon::now(),
                            'access_end_at'=> Carbon::now()->addDays(3),
                            'memo'=>'관리자 입주 확정 처리 승인',
                            'type'=>'outer-order-completed',
                            'status'=>'1'
                        ]);

                        $template=Template::whereCatalog('입주 확정')->whereUse('1')->first();
                        $template_content = $formatter->templateFormat($template->template, [
                            '#{회원명}' => $this->reservation->order_name,
                            '#{호텔명}' => $this->reservation->payments->last()->goods_name,
                            '#{호텔옵션}' => Str::of($this->reservation->payments->last()->goods_option)->replace(' (0박 0일)', ''),
                            '#{룸타입}' => $confirmation->room_type,
                            '#{입주확정일자}' => $formatter->carbonFormat($confirmation->start_dt, 'Y년 m월 d일(요일)'),
                            '#{퇴실확정일자}' => $formatter->carbonFormat($confirmation->end_dt, 'Y년 m월 d일(요일)'),
                            '#{체크인_date}' => $formatter->carbonFormat($confirmation->start_dt, 'Y년 m월 d일 H시i분')
                        ]);

                        $buttons=[
                            "button_type" => 'WL',
                            "button_name" => '호텔에삶 이용 안내서',
                            "button_url" => $confirmation->reservation->hotel->info_notion,
                            "button_url2" => $confirmation->reservation->hotel->info_notion
                        ];
                        $at = new AlertTalk([
                            'reserved_time'=>'',/*예약시간*/
                            're_send'=>'Y',
                            'tel' => $formatter->hpFormat($this->reservation->order_hp),
                            'template_code' => $template->code,
                            'template' => $template_content
                        ], $buttons);
//                        if(auth()->check() && auth()->user()->hasAnyRole('개발')){
//                            $at->setTel((string) Str::of(auth()->user()->phone)->replace('-',''));
//                        }
                        $at->send();

                        AlertTalkList::create([
                            'template_id'=>$template->id,
                            'reservation_id'=>$this->reservation->id ?? null,
                            'payment_id'=>$this->reservation->payments->last()->id ?? null,
                            'confirmation_id'=>$confirmation->id ?? null,
                            'hotel_id'=>$this->reservation->hotel->id ?? null,
                            'room_id'=>$this->reservation->room->id ?? null,
                            'catalog'=>$template->catalog,
                            'hp'=>$formatter->hpFormat($this->reservation->order_hp),
                            'result'=>'success',
                            'template'=>$template_content,
                            'send_at'=>Carbon::now(),
                        ]);
                        $this->hotelAdminSendMailConfirmation();
                    }
                break;

                case '고객_입주변경_알림톡':
                    $result='success';
                    $outerSend='입주 변경 + 고객 알림톡 전송';
                    $hotel=Hotel::find($this->reservation->hotel_id);

                    if($this->reservation){
                        $template=Template::whereCatalog('입주 변경')->whereUse('1')->first();
                        $template_content = $formatter->templateFormat($template->template, [
                            '#{회원명}' => $this->reservation->order_name,
                            '#{호텔명}' => $this->reservation->payments->last()->goods_name,
                            '#{호텔옵션}' => Str::of($this->reservation->payments->last()->goods_option)->replace(' (0박 0일)', ''),
                            '#{룸타입}' => $confirmation->room_type,
                            '#{입주일자}' => $formatter->carbonFormat($confirmation->start_dt, 'Y년 m월 d일(요일)'),
                            '#{퇴실일자}' => $formatter->carbonFormat($confirmation->end_dt, 'Y년 m월 d일 H시i분')
                        ]);

                        $buttons=[
                            "button_type" => 'WL',
                            "button_name" => '호텔에삶 이용 안내서',
                            "button_url" => $confirmation->reservation->hotel->info_notion,
                            "button_url2" => $confirmation->reservation->hotel->info_notion
                        ];

                        $at = new AlertTalk([
                            'reserved_time'=>'',/*예약시간*/
                            're_send'=>'Y',
                            'tel' => $formatter->hpFormat($this->reservation->order_hp),
                            'template_code' => $template->code,
                            'template' => $template_content
                        ],$buttons);
                        $at->send();

                        AlertTalkList::create([
                            'template_id'=>$template->id,
                            'reservation_id'=>$this->reservation->id ?? null,
                            'payment_id'=>$this->reservation->payments->last()->id ?? null,
                            'confirmation_id'=>$confirmation->id ?? null,
                            'hotel_id'=>$this->reservation->hotel->id ?? null,
                            'room_id'=>$this->reservation->room->id ?? null,
                            'catalog'=>$template->catalog,
                            'hp'=>$formatter->hpFormat($this->reservation->order_hp),
                            'result'=>'success',
                            'template'=>$template_content,
                            'send_at'=>Carbon::now(),
                        ]);
                        $this->hotelAdminSendMailConfirmation('변경');
                    }
                break;

                case '고객_입주연장_알림톡':
                    $result='success';
                    $add_day = null;
                    if($formData['add_day'] >=1){
                        $add_day = ' +'.$formData['add_day'].'박';
                    }
                    $outerSend='입주 연장'.$add_day.' + 고객 알림톡 전송';

                    if($this->reservation){
                        $template=Template::whereCatalog('입주 연장')->whereUse('1')->first();
                        $template_content = $formatter->templateFormat($template->template, [
                            '#{회원명}' => $this->reservation->order_name,
                            '#{호텔명}' => $this->reservation->payments->last()->goods_name,
                            '#{호텔옵션}' => Str::of($this->reservation->payments->last()->goods_option)->replace(' (0박 0일)', '').$add_day,
                            '#{퇴실일자}' => $formatter->carbonFormat($confirmation->end_dt, 'Y년 m월 d일 H시i분'),
                            '#{처리1}'=>'변경',
                            '#{연장위치}'=>'프론트',
                        ]);
                        $buttons=[
                            "button_type" => 'WL',
                            "button_name" => '호텔에삶 이용 안내서',
                            "button_url" => $confirmation->reservation->hotel->info_notion,
                            "button_url2" => $confirmation->reservation->hotel->info_notion
                        ];
                        $at = new AlertTalk([
                            'reserved_time'=>'',/*예약시간*/
                            're_send'=>'Y',
                            'tel' => $formatter->hpFormat($this->reservation->order_hp),
                            'template_code' => $template->code,
                            'template' => $template_content
                        ], $buttons);
                        $at->send();

                        AlertTalkList::create([
                            'template_id'=>$template->id,
                            'reservation_id'=>$this->reservation->id ?? null,
                            'payment_id'=>$this->reservation->payments->last()->id ?? null,
                            'confirmation_id'=>$confirmation->id ?? null,
                            'hotel_id'=>$this->reservation->hotel->id ?? null,
                            'room_id'=>$this->reservation->room->id ?? null,
                            'catalog'=>$template->catalog,
                            'hp'=>$formatter->hpFormat($this->reservation->order_hp),
                            'result'=>'success',
                            'template'=>$template_content,
                            'send_at'=>Carbon::now(),
                        ]);
                        $this->hotelAdminSendMailConfirmation('연장');
                    }
                break;


                case '고객_룸타입변경_알림톡':
                    $result='success';
                    $outerSend='룸 타입 변경 + 고객 알림톡 전송';
                    $hotel=Hotel::find($this->reservation->hotel_id);

                    if($this->reservation){
                        $template=Template::whereCatalog('룸 타입 변경')->whereUse('1')->first();

                        $template_content = $formatter->templateFormat($template->template, [
                            '#{회원명}' => $this->reservation->order_name,
                            '#{호텔명}' => $this->reservation->payments->last()->goods_name,
                            '#{호텔옵션}' => Str::of($this->reservation->payments->last()->goods_option)->replace(' (0박 0일)', ''),
                            '#{룸 타입}' => $confirmation->room_type,
                        ]);

                        $buttons=[
                            "button_type" => 'WL',
                            "button_name" => '호텔에삶 이용 안내서',
                            "button_url" => $confirmation->reservation->hotel->info_notion,
                            "button_url2" => $confirmation->reservation->hotel->info_notion
                        ];

                        $at = new AlertTalk([
                            'reserved_time'=>'',/*예약시간*/
                            're_send'=>'Y',
                            'tel' => $formatter->hpFormat($this->reservation->order_hp),
                            'template_code' => $template->code,
                            'template' => $template_content
                        ],$buttons);
                        $at->send();

                        AlertTalkList::create([
                            'template_id'=>$template->id,
                            'reservation_id'=>$this->reservation->id ?? null,
                            'payment_id'=>$this->reservation->payments->last()->id ?? null,
                            'confirmation_id'=>$confirmation->id ?? null,
                            'hotel_id'=>$this->reservation->hotel->id ?? null,
                            'room_id'=>$this->reservation->room->id ?? null,
                            'catalog'=>$template->catalog,
                            'hp'=>$formatter->hpFormat($this->reservation->order_hp),
                            'result'=>'success',
                            'template'=>$template_content,
                            'send_at'=>Carbon::now(),
                        ]);
                        $this->hotelAdminSendMailConfirmation('룸 타입 변경');
                    }
                break;

                case '호텔관리자_입주연장_문의' : /* 호텔 관리자에게 확정 처리 필요 메일 전송 > 호텔관리자 확인후 확정,변경필요 > 확정가능시 자동 확정처리*/
                    /* 이전 확정 처리 취소 처리? - 바로 적용 시 문제점 체크 - 바로 확정안될시 연기 - 결제중 입주중 체크 어려움 */
                    $this->forwardRescheduleConfirmationInquiry();
                    break;

                case '호텔관리자_입주변경_문의' : /* 호텔 관리자에게 확정 처리 필요 메일 전송 > 호텔관리자 확인후 확정,변경필요 > 확정가능시 자동 확정처리*/
                    $this->forwardRescheduleConfirmationInquiry('변경');
                    break;
            }

            $this->mount();
        }

        session(
            [
                'ConfirmationSubmit'=>[
                    'result'=>$result,
                    'resultMessage' => '저장 완료',
                    'outerSendResult'=>$outerSend,
                ]
            ]
        );
        $this->emitSelf('render');
        $this->emitTo('confirmations.confirmation-list','confirmationListRerender');
    }

    public function confirmationFormReRender(): void
    {
        $this->emitSelf('render');
    }
    public function render()
    {
        return view('livewire.admin.information.generation.confirmation.form');
    }

    public function forwardRescheduleConfirmationInquiry($type='연장')
    {
        External::where('reservation_id', '=', $this->reservation->id)->update([
           'status'=>1
        ]);
        $external=External::create([
            'reservation_id'=>$this->reservation->id,
            'hotel_id'=>$this->reservation->hotel_id,
            'access_key'=>Str::random(60),
            'access_at'=> Carbon::now(),
            'access_end_at'=> Carbon::now()->addDays(3),
            'memo'=>$this->reservation->type.' '.$type.' 확정 문의 호텔관리자에게 전달',
            'type'=>'outer-order-completed',
            'status'=>'0'
        ]);
        if($external){
            $data = [
                'subject'=>'[호텔에삶] 호텔 입주 '.$type.' 신청이 들어왔습니다.',
                'reservation' => $this->reservation,
                'reschedule_type'=>$type,
                'external'=>$external
            ];
            if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                foreach ($this->reservation->hotel->admin_emails as $index => $email){
                    Mail::mailer('info')->send('emails.outer.reschedule', $data, function($message) use ($data, $email,$type) {
                        $message->to($email, '호텔 관리자님')->subject('[DEV][호텔에삶] 호텔 입주 '.$type.' 신청이 들어왔습니다.');
                        $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME')); /*HOTEL_MANAGER_MAILER*/
                    });
                }
            }else{
                foreach ($this->reservation->hotel->living_emails as $index => $email){
                    Mail::mailer('hotel-manager')->send('emails.outer.reschedule', $data, function($message) use ($data, $email) {
                        $message->to($email, '호텔 관리자님')->subject($data['subject']);
                        $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'),env('HOTEL_MANAGER_MANAGER_MAIL_NICKNAME'));
                    });
                }
            }
            return true;
        }
        return false;
    }


    public function hotelAdminSendMailConfirmation($type='확정'): bool
    {
        $formatter = new Formatter();
        $hotel_room = HotelRoom::whereId($this->reservation->room_id)->first();
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
        $data = [
            'subject'=> '[호텔에삶]'.$this->reservation->order_name.'님 입주 '.$type.'되었습니다.',
            'type'=>$type,
            'reservation' => $this->reservation
        ];
        $admins = [
            'hotelmanager@travelmakers.kr'
        ];
        /*입주확정*/
        if($this->reservation->type ==='month'){

            if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                foreach ($this->reservation->hotel->admin_emails as $index => $email){
                    Mail::mailer('info')->send('emails.outer.order_completed_confirmation', $data, function($message) use ($email,$data) {
                        $message->to($email, '호텔 관리자님')->subject($data['subject']);
                        $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                    });
                }
            }else{
                foreach ($this->reservation->hotel->living_emails as $index => $email){
                    Mail::mailer('hotel-manager')->send('emails.outer.order_completed_confirmation', $data, function($message) use ($email,$data) {
                        $message->to($email, '호텔 관리자님')->subject($data['subject']);
                        $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'), env('HOTEL_MANAGER_MAIL_NICKNAME'));
                    });
                }
            }

            foreach ($admins as $index => $email){
                Mail::mailer('info')->send('emails.outer.order_completed_confirmation', $data, function($message) use ($email,$data) {
                    $message->to($email, '트래블메이커 관리자님')->subject($data['subject']);
                    $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                });
            }
            /* 정산 정보 존재시 메일 전송 체크 */
            if(isset($this->reservation->confirmation->payment_id)
                && $this->reservation->confirmation->payment_id !==''
                && $this->reservation->confirmation->payment_id !==null){
                $settlement = Settlement::where('payment_id', '=', $this->reservation->confirmation->payment_id)->latest()->first();
                if($settlement){
                    $settlement->mail_send_dt=now();
                    $settlement->save();
                }
            }
        }
        return true;
    }

}
