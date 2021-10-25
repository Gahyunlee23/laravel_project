<?php

namespace App\Http\Controllers\Payple;

use App\AlertTalk;
use App\AlertTalkList;
use App\Curator;
use App\External;
use App\Formatter;
use App\Hotel;
use App\HotelOption;
use App\HotelReservation;
use App\HotelRoom;
use App\HotelRoomType;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Schedule;
use App\Template;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 결제창 접근 또는 주문완료 접근
     * @param HotelReservation $reservation
     * @return Response
     */
    public function index(HotelReservation $reservation, $method='card')
    {
        $userAgent=$this->UserAgent();
        if($reservation){
            if(Carbon::now()->diffInHours($reservation->user->created_at) < 24 && $reservation->user->password_tmp !== null){
                /* 알림톡 전송 */
                $this->newMembershipRegistration($reservation);
            }
        }
        return response()->view('payment.index', [
            'method'=>$method,
            'reservation'=>$reservation,
            'hotel_option'=>$reservation->hotel->options->where('disable','=','N'),
            'mobileChk'=>$userAgent[0],
            'appleMobile'=>$userAgent[1],
            'androidMobile'=>$userAgent[2],
            'order_id'=>date('YmdHis').'-'.($reservation->order_id ?? mt_rand(1000,9999))
        ]);
    }
    /**
     * 취소 처리 Auth
     * @param HotelReservation $reservation
     * @return Response|string
     */
    public function cancel(HotelReservation $reservation)
    {
        $data=HotelReservation::find($reservation->id);
        if($data){
            return response()
                ->view('payment.cancel',
                    [
                        'reservation'=>$data,
                        'payment'=>$data->payment,
                        'hotel_option'=>$data->room->hotel->options->where('disable','=','N')
                    ],
                    200);
        }
        return '해당 결제 정보 없음';
    }



    /**
     * Display a listing of the resource.
     * DEV  결제창 접근 또는 주문완료 접근
     * @param HotelReservation $reservation
     * @return Response
     */
    public function devIndex(HotelReservation $reservation)
    {
        $data=HotelReservation::find($reservation->id);

        //ddd($data,$data->room->hotel->options->where('disable','=','N'));
        if($data->room === null || $data->order_status==='3'){
            return response()
                ->view('payment.index',
                    [
                        'progress'=>$data->order_status,
                        'reservation'=>$data,
                        'hotel_option'=>$data->room->hotel->options->where('disable','=','N')
                    ],
                    200);
        }

        return response()
            ->view('payment.dev-index',
                [
                    'progress'=>$data->order_status,
                    'reservation'=>$data,
                    'hotel_option'=>$data->room->hotel->options->where('disable','=','N')
                ],
                200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $status=8;
        $payment=false;
        if($request->message==='카드승인완료' && $request->result_message==='success'){
            $status=3;
        }
        $update_reservation = HotelReservation::find($request->reservation_id);
        if($update_reservation){/*주문 정보가 있어야 결제 정보 저장 ?*/
            $update_reservation->order_status=$status;
            $update_reservation->save();

            $request->merge([
                'goods_name' =>  Str::before($request->goods_name,'ㆍ'),
                'goods_option' =>  Str::after($request->goods_name,'ㆍ'),
                'status'=>$status,
                'order_completed_at'=> Carbon::parse(now()),
            ]);

            $payment=Payment::updateOrCreate(
                $request->only('reservation_id'),
                $request->all()
            );

            if($payment && $request->reservation_id!=='' && $request->reservation_id!==null
                && $request->message==='카드승인완료' && $request->result_message==='success'){
                $ATCheck=$this->paymentByIdToAT($payment->id);

                $outerCheck = $this->outerMailSend($request->reservation_id);
                $this->mailSend($request->reservation_id, $ATCheck,$outerCheck);

            }else{
                $this->failMailSend($request->reservation_id);
            }
            return response()
                ->json([
                    'status'=>'success',
                    'payment'=>$payment
                ]);
        }

        $request->merge([
            'memo' => '주문정보 없어 결제 실패 처리'
        ]);
        Payment::updateOrCreate(
            $request->only('reservation_id'),
            $request->all()
        );
        return response()
            ->json([
                'status'=>'false',
                'message'=>'결제정보가 없습니다.'
        ]);

    }

    public function storeRestProcess(Request $request): RedirectResponse
    {
        $update_reservation = HotelReservation::find($request->PCD_PAYER_NO);
        $status=8;
        if($update_reservation){/* 주문 정보가 있어야 결제 정보 저장 */
            if((($request->PCD_PAY_MSG==='출금이체완료' || $request->PCD_PAY_MSG==='카드승인완료') && $request->PCD_PAY_RST==='success')
                || $update_reservation->order_status === '3'){
                $status=3;
            }
            $update_reservation->order_status=$status;
            $update_reservation->save();

            $request->merge([
                'goods_name' =>  Str::before($request->PCD_PAY_GOODS,'ㆍ'),
                'goods_option' =>  Str::after($request->PCD_PAY_GOODS,'ㆍ'),
                'status'=>$status,
                'order_completed_at'=> Carbon::parse(now()),
            ]);

            $payment=null;
            if(empty($update_reservation->payment) || ($update_reservation->payment && $update_reservation->payment->status!=='3')){
                $payment=Payment::updateOrCreate(
                    ['reservation_id'=>$request->PCD_PAYER_NO],
                    [
                        'order_id'=>$request->PCD_PAY_OID,
                        'card_type'=>$request->PCD_CARD_VER,
                        'pay_type'=>$request->PCD_PAY_TYPE,
                        'pay_url'=>$request->PCD_PAY_URL,
                        'name'=>$request->PCD_PAYER_NAME,
                        'email'=>$request->PCD_PAYER_EMAIL,
                        'hp'=>$request->PCD_PAYER_HP,
                        'status'=>$request->status,
                        'goods_name'=>$request->goods_name,
                        'goods_option'=>$request->goods_option,
                        'goods_tax'=>$request->PCD_PAY_ISTAX,
                        'total_price'=>$request->PCD_PAY_TOTAL,
                        'result_message'=>$request->PCD_PAY_RST,
                        'message'=>$request->PCD_PAY_MSG,
                        'order_completed_at'=>$request->order_completed_at,
                        'referer_url'=>$request->PCD_HTTP_REFERER,
                    ]
                );
            }

            Log::channel('slack-reservation')->debug($update_reservation);
            Log::channel('slack-reservation')->debug($payment);
            Log::channel('slack-reservation')->debug($request);
            if((isset($payment) && $request->PCD_PAYER_NO!=='' && $request->PCD_PAYER_NO!==null
                && $request->PCD_PAY_MSG==='카드승인완료' && $request->PCD_PAY_RST==='success')
                || (isset($payment) && $payment->status === '3')){
                    $ATCheck=$this->paymentByIdToAT($payment->id);
                    $outerCheck = $this->outerMailSend($request->PCD_PAYER_NO);
                    $this->mailSend($request->PCD_PAYER_NO, $ATCheck,$outerCheck);
            }else{
                $this->failMailSend($request->PCD_PAYER_NO);
//                if($update_reservation->order_name==='노한결' && $status === 8){/* 카드 승인 실패*/
//                    $this->failAlertTalkSend($request->PCD_PAYER_NO);
//                }else if($update_reservation->order_name==='노한결' && $status === 3){/*승인됬지만 결제정보 전달 > 저장 오류*/
//                    $this->failAlertTalkSend($request->PCD_PAYER_NO);
//                }
            }
            return redirect()->route('reservations.order_completed',[
                'reservation'=>$update_reservation->id
            ]);
        }
        return redirect()->route('reservations.order_completed',[
            'reservation'=>$request->PCD_PAYER_NO
        ]);
    }

    /**
     * 관리자 > 주문관리 > 투어 신청 내역 중 결제 전환 처리 진행 api
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reservationCompleted(Request $request): \Illuminate\Http\JsonResponse
    {
        $payment=Payment::updateOrCreate(
            $request->only('reservation_id'),
            $request->all()
        );

        if(!$payment){
            return response()
                ->json([
                    'status'=>'fail'
            ]);
        }
        HotelReservation::whereId($request->only( 'reservation_id'))->update(['order_status'=>'3']);

        return response()
            ->json([
                'status'=>'success',
                'data'=>$payment
        ]);
    }

    public function reSend(): void
    {
       /* $reservation_id='6630';
        $this->mailSend($reservation_id, true);
        $this->outerMailSend($reservation_id);*/
    }

    protected function UserAgent(): array
    {

        $appleMobileAgent = ["iPhone","iphone", "iPod", "ipad"];
        $androidMobileAgent = ["Android", "Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony"];
        $appleMobile = false;
        $androidMobile = false;
        $mobileChk = false;

        for ($i = 0,$iMax = sizeof($appleMobileAgent); $i < $iMax; $i++) {
            if (stripos($_SERVER['HTTP_USER_AGENT'], $appleMobileAgent[$i])) {
                $appleMobile = true;
                $mobileChk = true;
                break;
            }
        }

        for ($i = 0,$iMax = sizeof($androidMobileAgent); $i < $iMax; $i++) {
            if (stripos($_SERVER['HTTP_USER_AGENT'], $androidMobileAgent[$i])) {
                $androidMobile = true;
                $mobileChk = true;
                break;
            }
        }
        return [$mobileChk,$appleMobile,$androidMobile];
    }

    /* 결제 오늘 회원가입 인원인 경우 알림톡 전달 */
    protected function newMembershipRegistration(HotelReservation $reservation): ?bool
    {
        if($reservation){
            $formatter = new Formatter();
            $templateCatalog = '자동 회원가입 안내';
            $template = Template::whereCatalog($templateCatalog)->whereUse('1')->first();
            if($formatter->hpFormat($reservation->order_hp) != '' && $formatter->hpFormat($reservation->order_hp) !== null){
                if(AlertTalkList::whereHp($formatter->hpFormat($reservation->order_hp))->whereCatalog($templateCatalog)->count() === 0){
                    $template_content=$formatter->templateFormat($template->template, [
                        '#{회원명}' => $reservation->order_name,
                        '#{비회원}'=>'비회원으로 ',
                        '#{상태}'=>'주문 시',
                        '#{진행방식}'=>'',
                        '#{사용방법}'=>'주문 내역 확인이 가능한 ',
                        '#{접근경로}'=>'‘마이페이지 -> 개인 정보 -> 비밀번호 변경’을 '
                    ]);
                    $data = [
                        'reserved_time'=>'',
                        're_send'=>'Y',
                        'tel' => $formatter->hpFormat($reservation->order_hp),
                        'template_code' => $template->code,
                        'template' =>$template_content
                    ];
                    $buttons=[
                        "button_type" => 'WL',
                        "button_name" => '호텔에삶 보러가기',
                        "button_url" => 'https://www.livinginhotel.com/login',
                        "button_url2" => 'https://www.livinginhotel.com/login'
                    ];

                    $at = new AlertTalk($data, $buttons);
                    $at->send();

                    AlertTalkList::create([
                        'template_id'=>$template->id ?? null,
                        'reservation_id'=>$reservation->id,
                        'payment_id'=>$payment->id ?? null,
                        'confirmation_id'=>null,
                        'hotel_id'=>$reservation->hotel->id,
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
        }
        return false;
    }

    protected function paymentByIdToAT($payment_id): ?bool
    {
        $formatter = new Formatter();

        $payment = Payment::find($payment_id);
        $reservation = HotelReservation::find($payment->reservation_id);

        if($payment && $reservation){
            //$hotel_option = $reservation->hotel->options->where('disable','=','N')->first();
            $hotel_room = $reservation->room;
            //$hotel_room_option = ( $hotel_room->nights !=='' ? '('.$hotel_room->nights.'박' : null ) .( $hotel_room->days !=='' ? ' '.$hotel_room->days.'일)' : null );
            $hotel_room_options = $payment->goods_option;
            $hotel_room_type = $hotel_room->main_explanation;
            if($reservation->room_type_id){
                $order_hotel_room_type=HotelRoomType::find( ($reservation->room_type_upgrade_id ?? $reservation->room_type_id) );
                $hotel_room_type = $order_hotel_room_type->name .''. ( $reservation->room_type_upgrade_id ? '(룸 업그레이드)' : '' );
            }

                $template = Template::whereCatalog('결제 완료')->whereUse('1')->first();
                $template_content=$formatter->templateFormat($template->template, [
                    '#{회원명}' => $reservation->order_name,
                    '#{호텔명}' => $payment->goods_name,
                    '#{호텔옵션}' => $hotel_room_options,
                    '#{룸타입}' => $hotel_room_type,
                    '#{주문번호}' => Str::after($payment->order_id,'-'),
                ]);
                $data = [
                    'reserved_time'=>'',/*예약시간*/
                    're_send'=>'Y',
                    'tel' => $formatter->hpFormat($reservation->order_hp),
                    'template_code' => $template->code,
                    'template' =>$template_content
                ];

                $at = new AlertTalk($data);
                $at->send();

                AlertTalkList::create([
                    'template_id'=>$template->id ?? null,
                    'reservation_id'=>$reservation->id,
                    'payment_id'=>$payment->id ?? null,
                    'confirmation_id'=>null,
                    'hotel_id'=>$reservation->hotel->id,
                    'room_id'=>$hotel_room->id ?? null,
                    'catalog'=>$template->catalog ?? null,
                    'hp'=>$formatter->hpFormat($reservation->order_hp),
                    'result'=>'success',
                    'template'=>$template_content,
                    'send_at'=>Carbon::now(),
                ]);
                return true;

        }
        return false;
    }

    protected function failAlertTalkSend($reservation_id, $type = '주문 오류'): ?bool
    {
        $formatter = new Formatter();
        $reservation = HotelReservation::find($reservation_id);

        if($reservation){
                $template = Template::whereCatalog($type)->whereUse('1')->first();

                $data = [
                    'reserved_time'=>'',/*예약시간*/
                    're_send'=>'Y',
                    'tel' => $formatter->hpFormat($reservation->order_hp),
                    'template_code' => $template->code,
                    'template' =>$template->template
                ];

                $at = new AlertTalk($data);
                $at->send();

                AlertTalkList::create([
                    'template_id'=>$template->id ?? null,
                    'reservation_id'=>$reservation->id ?? null,
                    'payment_id'=>$payment->id ?? null,
                    'confirmation_id'=>null,
                    'hotel_id'=>$reservation->hotel->id ?? null,
                    'room_id'=>$hotel_room->id ?? null,
                    'catalog'=>$template->catalog ?? null,
                    'hp'=>$formatter->hpFormat($reservation->order_hp),
                    'result'=>'success',
                    'template'=>$template->template,
                    'send_at'=>Carbon::now(),
                ]);
                return true;

        }
        return false;
    }

    public function paypleAuth(): Response
    {
        return response()->view(
            'payple.auth',
            []
        );
    }
    public function paypleCancelAuth(): Response
    {
        return response()->view(
            'payple.cancel-auth',
            []
        );
    }

    protected function mailSend($id, $ATCheck, $outerCheck): void
    {
        $admins = [
            [
                'email'=>'danyep@naver.com',
                'name'=>'박단예'
            ],
            [
                'email'=>'hotelmanager@travelmakers.kr',
                'name'=>'정승재'
            ],
            [
                'email'=>'travelmakerkorea_k@naver.com',
                'name'=>'김병주'
            ]
        ];

        $reservation = HotelReservation::find($id);

        if($reservation){
            if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                $subject = '[DEV][호텔에삶/호텔/결제완료]'.$reservation->order_name . '님';
            }else{
                $subject = '[호텔에삶/호텔/결제완료]'.$reservation->order_name . '님';
            }
            $data = [
                'ATCheck'=>$ATCheck,
                'outerCheck'=>$outerCheck,
                'name'=>$reservation->order_name,
                'reservation' => $reservation,
                'hotel' => Hotel::whereId($reservation->hotel_id)->whereStatus('2')->first(),
                'room' => HotelRoom::whereId($reservation->room_id)->whereDisable('N')->first(),
                'curator' => Curator::whereId($reservation->curator_id)->whereVisible('1')->first(),
                'payment' => Payment::whereReservationId($reservation->id)->orderBy('id')->first(),
            ];

            foreach ($admins as $index => $user){
                Mail::mailer('info')->send('emails.order_completed', $data, function($message) use ($user, $data, $subject) {
                    $message->to($user['email'],$user['name'])->subject($subject);
                    $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME')); /*HOTEL_MANAGER_MAILER*/
                });
            }
        }
    }

    protected function failMailSend($id): void
    {
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

        $reservation = HotelReservation::find($id);

        if($reservation){

            $subject='';
            if($reservation->type==='month'){
                $subject='[호텔에삶/호텔/결제시도중팝업종료]'.$reservation->order_name . '님';
            }

            $data = [
                'ATCheck'=>false,
                'subject'=> $subject,
                'name'=>$reservation->order_name,
                'reservation' => $reservation,
                'hotel' => Hotel::whereId($reservation->hotel_id)->whereStatus('2')->first(),
                'room' => HotelRoom::whereId($reservation->room_id)->whereDisable('N')->first(),
                'curator' => Curator::whereId($reservation->curator_id)->whereVisible('1')->first(),
                'payment' => Payment::whereReservationId($reservation->id)->orderBy('id')->first(),
            ];

            foreach ($admins as $index => $user){
                Mail::mailer('info')->send('emails.order_failed', $data, function($message) use ($user,$data) {
                    $message->to($user['email'],$user['name'])->subject($data['subject']);
                    $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                });
            }
        }
    }

    protected function outerMailSend ($id)
    {
        $reservation = HotelReservation::find($id);
        if($reservation){
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
                    'subject'=> '[호텔에삶] 호텔 입주 신청이 들어왔습니다.',
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
                if($reservation->type==='month'){
                    $sendMails='';
                    if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                        foreach ($hotel->admin_emails as $index => $email) {
                            Mail::mailer('info')->send('emails.outer.order_completed', $data, function ($message) use ($data, $email) {
                                $message->to($email, '호텔 관리자님')->subject($data['subject']);
                                $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                            });
                        }
                        $sendMails=$hotel->admin_emails;
                    }else{
                        foreach ($hotel->living_emails as $index => $email) {
                            Mail::mailer('hotel-manager')->send('emails.outer.order_completed', $data, function ($message) use ($data, $email) {
                                $message->to($email, '호텔 관리자님')->subject($data['subject']);
                                $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'), env('HOTEL_MANAGER_MAIL_NICKNAME'));
                            });
                        }
                        $sendMails=$hotel->living_emails;
                    }
                    return $sendMails;
                }
            }
        }
    }
    protected function adminMailSend ($id): void
    {
        $reservation = HotelReservation::find($id);
        if($reservation){
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
                $subject='';
                $hotel_room = HotelRoom::whereId($reservation->room_id)->first();
                if($reservation->type==='month'){
                    $subject='[호텔에삶] 호텔 입주 신청이 들어왔습니다.';
                }else if($reservation->type==='tour'){
                    $subject='[호텔에삶] 호텔 투어 신청이 들어왔습니다.';
                }
                $hotel = Hotel::whereId($reservation->hotel_id)->whereStatus('2')->first();
                $data = [
                    'subject'=> $subject,
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
                foreach ($hotel->admin_emails as $index => $email){
                    Mail::mailer('info')->send('emails.outer.order_completed', $data, function($message) use ($email,$data) {
                        $message->to($email, '호텔 관리자님')->subject($data['subject']);
                        $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                    });
                }
            }
        }
    }

}
