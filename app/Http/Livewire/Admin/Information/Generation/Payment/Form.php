<?php

namespace App\Http\Livewire\Admin\Information\Generation\Payment;

use App\AlertTalk;
use App\Curator;
use App\External;
use App\Formatter;
use App\Hotel;
use App\HotelOption;
use App\HotelReservation;
use App\HotelRoom;
use App\Payment;
use App\Rules\PhoneNumber;
use App\Settlement;
use App\Template;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    public $reservation_id;
    public $reservation;

    public $payment;
    public $settlements;

    public $process='none';

    public $admins = [
        [
            'email'=>'hotelmanager@travelmakers.kr',
            'name'=>'정승재'
        ],
        [
            'email'=>'travelmakerkorea_k@naver.com',
            'name'=>'김병주'
        ]
    ];

    protected $listeners = [
        'paymentFormReRender' => 'render',
        'paymentDataLoadEvent' => 'dataLoad'
    ];

    public function mount(){
        $this->dataLoad();
    }
    public function dataLoad(){
        if($this->reservation_id){
            $this->payment=Payment::whereReservationId($this->reservation_id)->latest()->first();
            $this->reservation=HotelReservation::find($this->reservation_id);
            if($this->payment){
                $this->payment = ($this->payment)->toArray();
            }else{
                if($this->reservation){
                    $this->payment['name']=$this->reservation->order_name;
                    $this->payment['email']=$this->reservation->order_email;
                    $this->payment['hp']=$this->reservation->order_hp;
                    $this->payment['total_price']=$this->reservation->order_sale_price;
                    $this->payment['goods_name']=$this->reservation->hotel->options->where('disable','=','N')->first()->title;
                }
                if($this->reservation->room){
                    $this->payment['goods_option']=($this->reservation->room->title ?? '').' '
                        .( $this->reservation->room->nights !== null ? '('.($this->reservation->room->nights ?? '').'박' : null )
                        .( $this->reservation->room->days !== null ? ' '.$this->reservation->room->days.'일)' : null );
                }
            }
        }
    }

    public function rules(): array
    {
        return [
            'payment.name' => ['required'],
            'payment.email' => ['required','email'],
            'payment.hp' => ['required', new PhoneNumber()],
            'payment.status' => ['required'],
            'payment.card_type' => ['required'],
            'payment.total_price' => ['required','numeric'],
            'payment.add_price' => [],
            'payment.goods_name' => ['required'],
            'payment.goods_option' => ['required'],
            'payment.memo' => [''],
            'payment.order_id' => [''],
            'settlements.calculate' => [''],
            'settlements.memo' => [''],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function messages(): array
    {
        return [
            'payment.name.required' => '성명 필수 사항입니다.',
            'payment.email.required' => '이메일 필수 사항입니다.',
            'payment.email.email' => '이메일 형식이 아닙니다.',
            'payment.hp.required' => '연락처 필수 사항입니다.',
            'payment.status.required' => '결제상태 필수 사항입니다.',
            'payment.card_type.required' => '결제수단 필수 사항입니다.',
            'payment.total_price.required' => '결제금액 필수 사항입니다.',
            'payment.total_price.numeric' => '결제금액은 숫자만 입력가능합니다.',
            'payment.goods_name.required' =>'결제상품명 필수 사항입니다.',
            'payment.goods_option.required'=>'결제상품옵션 필수 사항입니다.',
        ];
    }

    public function paymentSubmit(): void
    {
        $formatter = new Formatter();
        $outerSend='결제 정보 저장완료';
        $result='save';

        $formData = $this->validate($this->rules());
        //ddd($formData['settlements']);
        if(!isset($formData['payment']['order_id']) || $formData['payment']['order_id'] ===null || $formData['payment']['order_id'] === ''){
            $formData['payment']['order_id']=Carbon::now()->format('YmdHis').'-'.mt_rand(1000, 9999);
        }
        if(isset($formData['payment']['hp'])){
            $formData['payment']['hp'] = Str::of($formData['payment']['hp'])->replace('-','');
        }
        $formData['payment']['reservation_id']=$this->reservation_id;
        $formData['payment']['goods_tax']='Y';
        switch ($formData['payment']['status']) {
            case '3':
                $formData['payment']['order_completed_at'] = Carbon::now()->format('Y-m-d H:i:s');
                $formData['payment']['message']='카드승인완료';
                $formData['payment']['result_message']='success';
                break;
            case '8':
                $formData['payment']['message']='결제를 종료하였습니다.';
                $formData['payment']['result_message']='close';
                break;
        }
        $formData['payment']['pay_type']='card';
        $formData['payment']['order_completed_at']=now();
        $formData['payment']['message']='카드승인완료';
        $formData['payment']['result_message']='success';
        if(trim($formData['payment']['add_price']) === ''){
            $formData['payment']['add_price'] = null;
        }
        $payment=Payment::create(
            $formData['payment']
        );
        $this->payment['id']=$payment->id;

        if($payment){
            switch ($this->process) {
                case '호텔_입주확정문의':
                    $result='success';
                    $outerSend='결제 정보 저장 + 호텔관리자에게 확정문의 메일 전송';
                    $reservation=HotelReservation::find($this->reservation_id);
                    $hotel=Hotel::find($reservation->hotel_id);
                    $hotel_option=$hotel->options->where('disable','=','N')->first();
                    $hotel_room = $hotel->rooms->where('disable','=','N')->first();
                    $curator=Curator::find($reservation->curator_id);

                    if($reservation){
                        External::whereReservationId($reservation->id)->whereHotelId($reservation->hotel_id)
                            ->whereStatus(0)->whereMemo($reservation->type.' 신청 문의 호텔관리자에게 전달')
                            ->update(['status'=>1]);
                        $external=External::create([
                            'reservation_id'=>$reservation->id,
                            'hotel_id'=>$reservation->hotel_id,
                            'access_key'=>Str::random(60),
                            'access_at'=> Carbon::now(),
                            'access_end_at'=> Carbon::now()->addDays(3),
                            'memo'=>$reservation->type.' 신청 문의 호텔관리자에게 전달',
                            'type'=>'outer-order-completed',
                            'status'=>'0'
                        ]);
                        if($external){
                            $data = [
                                'reservation' => $reservation,
                            ];
                            if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                                foreach ($hotel->admin_emails as $index => $email){
                                    Mail::mailer('info')->send('emails.outer.order_completed', $data, function($message) use ($data, $email) {
                                        $message->to($email, '호텔 관리자님')->subject('[DEV][호텔에삶] 호텔 입주 신청이 들어왔습니다.');
                                        $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                                    });
                                }
                            }else{
                                foreach ($hotel->living_emails as $index => $email){
                                    Mail::mailer('hotel-manager')->send('emails.outer.order_completed', $data, function($message) use ($data, $email) {
                                        $message->to($email, '호텔 관리자님')->subject('[호텔에삶] 호텔 입주 신청이 들어왔습니다.');
                                        $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'),env('HOTEL_MANAGER_MANAGER_MAIL_NICKNAME'));
                                    });
                                }
                            }
                        }
                    }
                break;
            }
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
        $this->emit('reMountEvent');
        $this->emit('reRenderEvent');
        $this->emitTo('payments.payment-list','paymentListRerender');
    }
    public function render()
    {
        return view('livewire.admin.information.generation.payment.form');
    }

    protected function mailSend($sendList, $data): void
    {
        foreach ($sendList as $index => $sendTarget) {
            Mail::mailer('hotel-manager')->send('emails.outer.order_completed', $data, function ($message) use ($sendTarget, $data) {
                $message->to($sendTarget, '호텔 관리자님')->subject($data['subject']);
                $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'), env('HOTEL_MANAGER_MAIL_NICKNAME'));
            });
        }
    }
}
