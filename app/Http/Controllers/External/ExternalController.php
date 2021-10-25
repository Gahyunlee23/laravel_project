<?php

namespace App\Http\Controllers\External;

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
use App\Http\Controllers\Controller;
use App\Payment;
use App\Schedule;
use App\Template;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ExternalController extends Controller
{
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

    public function confirmationChecking(string $key)
    {
        $external = $this->access($key, 'outer-order-completed');
        if ($external) {
            if($external->status!=='error'){
                $external->click_at= Carbon::now();
                $external->save();
            }
            return view('externals.robot-check',
                [
                    'type'=>'확정',
                    'key'=>$key
                ]
            );
        }
    }
    /**
     * 호텔 입주 확정
     *
     * @param string $key
     * @return External|External[]|bool|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\View\View
     */
    public function confirmation(string $key)
    {
        $external = $this->access($key, 'outer-order-completed');
        if ($external) {
            if ($external->status==='0') {
                /* 투어 확정 진행 / 입주는 관리자에게 입주 확정 진행 필요 전송*/
                $reservation = HotelReservation::find($external->reservation_id);
                if ($reservation) {

                    if ($reservation->type === 'month') {
                        $hotel = Hotel::whereId($reservation->hotel_id)->whereStatus('2')->first();
                        $hotel_option = HotelOption::whereHotelId($reservation->hotel_id)->whereDisable('N')->first();
                        $hotel_room = HotelRoom::whereId($reservation->room_id)->first();
                        $curator = Curator::whereId($reservation->curator_id)->whereVisible('1')->first();
                        $payment = Payment::whereReservationId($reservation->id)->orderBy('id')->first();
                        $formatter = new Formatter();

                        $subject = '[호텔에삶/호텔/입주확정필요]' . $reservation->order_name . '님';

                        if($reservation->confirmations->count()>=2){
                            $beforeConfirmation = $reservation->confirmations->get($reservation->confirmations->count()-2);
                            $confirmation = $reservation->confirmations->get($reservation->confirmations->count()-1);
                            if(isset($confirmation) &&
                                ($beforeConfirmation->start_dt !== $confirmation->start_dt
                                    || $beforeConfirmation->end_dt !== $confirmation->end_dt)){
                                $subject = '[호텔에삶/호텔/입주(변경,연장)확정필요]' . $reservation->order_name . '님';
                            }
                        }

                        $data = [
                            'subject' => $subject,
                            'name' => $reservation->order_name,
                            'reservation' => $reservation,
                            'hotel' => $hotel,
                            'hotel_option' => $hotel_option,
                            'room' => $hotel_room,
                            'curator' => $curator,
                            'payment' => $payment,
                            'formatter'=> $formatter
                        ];
                        if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                            foreach ($reservation->hotel->admin_emails as $index => $email) {
                                Mail::mailer('info')->send('emails.outer.confirmation', $data, function ($message) use ($email, $data) {
                                    $message->to($email, '트메 관리자')->subject($data['subject']);
                                    $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                                });
                            }
                        }else{
                            foreach ($this->admins as $index => $user) {
                                Mail::mailer('info')->send('emails.outer.confirmation', $data, function ($message) use ($user, $data) {
                                    $message->to($user['email'], $user['name'])->subject($data['subject']);
                                    $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                                });
                            }
                        }

                        $external->enter_at = Carbon::now();
                        $external->status = '1';
                        $external->memo = $reservation->order_name.'님 입주 확정 필요 요청';
                        $external->save();

                        return view('externals.mail_forward_to_tm_manager',
                            [
                                'status'=>'success',
                                'type'=>'ok',
                                'external'=>$external,
                                'reservation'=>$reservation,
                                'hotel'=>$hotel,
                                'hotel_option'=>$hotel_option,
                                'hotel_room'=>$hotel_room,
                                'curator'=>$curator,
                                'payment'=>$payment,
                                'formatter'=>$formatter
                            ]
                        );//'호텔살기 입주 확정 트래블메이커 매니저 전달 완료';

                    }

	                if ($reservation->type === 'tour') {
	                    /* 회원에게 알림톡 전송 처리 진행*/
	                    $external = $this->access($key, 'outer-order-completed');
	                    if ($external) {
	                        if ($external->status === '0') {
	                            $reservation = HotelReservation::find($external->reservation_id);
	                            if ($reservation) {
	                                $hotel = Hotel::whereId($reservation->hotel_id)->whereStatus('2')->first();
	                                $hotel_option = HotelOption::whereHotelId($reservation->hotel_id)->whereDisable('N')->first();
	                                $hotel_room = HotelRoom::whereId($reservation->room_id)->first();
	                                $curator = Curator::whereId($reservation->curator_id)->whereVisible('1')->first();
	                                $payment = Payment::whereReservationId($reservation->id)->orderBy('id')->first();
	                                $formatter = new Formatter();
	                                //$hotel_option = $reservation->hotel->options->where('disable', '=', 'N')->first();
	                                $template = Template::whereCatalog('투어 확정')->whereUse('1')->first();
	                                $template_content=$formatter->templateFormat($template->template, [
	                                    '#{회원명}' => $reservation->order_name,
	                                    '#{처리1}' => '확정',
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

	                                $data = [
	                                    'subject' => '[호텔에삶/호텔/투어확정완료]' . $reservation->order_name . '님',
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

	                                $external->enter_at = Carbon::now();
	                                $external->status = '1';
	                                $external->memo = $reservation->order_name.'님 투어 확정 완료';
	                                $external->save();
                                    $reservation->order_status=5;
                                    $reservation->save();

	                                $confirmation=Confirmation::updateOrCreate(
	                                [
	                                    'type' => 'HotelTour',
	                                    'reservation_id' =>$reservation->id
	                                ],
	                                [
	                                    'type' => 'HotelTour',
	                                    'reservation_id' =>$reservation->id,
	                                    'start_dt'=>Carbon::parse($reservation->order_desired_dt)->format('Y-m-d H:i:s'),
	                                    'end_dt'=>null,
	                                    'memo'=>$reservation->order_name.'님 투어 확정 완료',
	                                    'status'=>'1'
	                                ]);

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
	                                    'subject'=> '[호텔에삶]'.$reservation->order_name.'님 투어 확정되었습니다.',
	                                    'type'=>'확정',
	                                    'name'=>$reservation->order_name,
	                                    'reservation' => $reservation,
	                                    'hotel' => $hotel ?? null,
	                                    'hotel_option' => $hotel_option ?? null,
	                                    'room' => $hotel_room ?? null,
	                                    'payment' => $payment ?? null,
	                                    'external'=>$external,
	                                    'formatter'=> $formatter
                                    ];
                                    /*투어확정*/
                                    foreach ($hotel->tour_emails as $index => $email){
	                                    Mail::mailer('hotel-manager')->send('emails.outer.order_completed_confirmation', $data, function($message) use ($email ,$data) {
		                                    $message->to($email, '호텔 관리자님')->subject($data['subject']);
                                            $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'),env('HOTEL_MANAGER_MANAGER_MAIL_NICKNAME'));
	                                    });
                                    }

	                                return view('externals.mail_forward_to_tm_manager',
	                                    [
	                                        'status'=>'success',
	                                        'type'=>'ok',
	                                        'external'=>$external,
	                                        'reservation'=>$reservation,
	                                        'hotel'=>$hotel,
	                                        'hotel_option'=>$hotel_option,
	                                        'hotel_room'=>$hotel_room,
	                                        'curator'=>$curator,
	                                        'payment'=>$payment,
	                                        'formatter'=>$formatter
	                                    ]
	                                );
	                            }
	                            return view('externals.mail_forward_to_tm_manager',
	                                [
	                                    'status'=>'error',
	                                    'type'=>'ok'
	                                ]
	                            );
	                        }
	                        return view('externals.mail_forward_to_tm_manager',
	                            [
	                                'status'=>'fail',
	                                'type'=>'ok'
	                            ]
	                        );
	                    }

	                    return view('externals.mail_forward_to_tm_manager',
	                        [
	                            'status'=>'error',
	                            'type'=>'ok'
	                        ]
	                    );
	                }
                }
            }else if ($external->status==='1'){
                return view('externals.mail_forward_to_tm_manager',
                    [
                        'status'=>'fail',
                        'type'=>'ok'
                    ]
                );
            }
        }
        return view('externals.mail_forward_to_tm_manager',
            [
                'status'=>'error',
                'type'=>'ok'
            ]
        );
    }

    public function confirmationChangeChecking(string $key)
    {
        $external = $this->access($key, 'outer-order-completed');
        if ($external) {
            if($external->status!=='error'){
                $external->click_at = Carbon::now();
                $external->save();
            }
            return view('externals.robot-check',
                [
                    'type'=>'변경',
                    'key'=>$key
                ]
            );
        }
    }
    /**
     * 호텔 입주 변경
     *
     * @param $key
     * @return External|External[]|bool|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\View\View
     * @throws \Exception
     */
    public function confirmationChange(string $key)
    {
        $external = $this->access($key, 'outer-order-completed');
        if($external){
            if ($external->status==='0') {
                $reservation = HotelReservation::find($external->reservation_id);
                if ($reservation) {

                    $hotel = Hotel::whereId($reservation->hotel_id)->whereStatus('2')->first();
                    $hotel_option = HotelOption::whereHotelId($reservation->hotel_id)->whereDisable('N')->first();
                    $hotel_room = HotelRoom::whereId($reservation->room_id)->first();
                    $curator = Curator::whereId($reservation->curator_id)->whereVisible('1')->first();
                    $payment = Payment::whereReservationId($reservation->id)->orderBy('id')->first();
                    $formatter = new Formatter();
                    $subject = '';
                    if ($reservation->type === 'month') {
                        $subject = '[호텔에삶/호텔/입주일정변경필요]' . $reservation->order_name . '님';

                        if($reservation->confirmations->count()>=2){
                            $beforeConfirmation = $reservation->confirmations->get($reservation->confirmations->count()-2);
                            $confirmation = $reservation->confirmations->get($reservation->confirmations->count()-1);
                            if(isset($confirmation) && ($beforeConfirmation->start_dt !== $confirmation->start_dt
                                || $beforeConfirmation->end_dt !== $confirmation->end_dt)){
                                $subject = '[호텔에삶/호텔/입주(변경,연장)변경필요]' . $reservation->order_name . '님';
                            }
                        }
                    } else if ($reservation->type === 'tour') {
                        $subject = '[호텔에삶/투어/투어일정변경필요]' . $reservation->order_name . '님';
                    }
                    $data = [
                        'subject' => $subject,
                        'name' => $reservation->order_name,
                        'reservation' => $reservation,
                        'hotel' => $hotel,
                        'room' => $hotel_room,
                        'curator' => $curator,
                        'payment' => $payment,
                        'formatter'=> $formatter
                    ];
                    if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                        foreach ($reservation->hotel->admin_emails as $index => $email) {
                            Mail::mailer('info')->send('emails.outer.confirmation_change', $data, function ($message) use ($email, $data) {
                                $message->to($email, '트메 관리자')->subject($data['subject']);
                                $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                            });
                        }
                    }else{
                        foreach ($this->admins as $index => $user) {
                            Mail::mailer('info')->send('emails.outer.confirmation_change', $data, function ($message) use ($user, $data) {
                                $message->to($user['email'], $user['name'])->subject($data['subject']);
                                $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                            });
                        }
                    }

                    $external->enter_at = Carbon::now();
                    $external->status = '1';
                    $external->memo = $reservation->order_name.'님 일정변경 필요 요청';
                    $external->save();

                    return view('externals.mail_forward_to_tm_manager',
                        [
                            'status'=>'success',
                            'type'=>'change',
                            'external'=>$external,
                            'reservation'=>$reservation,
                            'hotel'=>$hotel,
                            'hotel_option'=>$hotel_option,
                            'hotel_room'=>$hotel_room,
                            'curator'=>$curator,
                            'payment'=>$payment,
                            'formatter'=>$formatter
                        ]
                    );
                }
            }else if ($external->status==='1') {
                return view('externals.mail_forward_to_tm_manager',
                    [
                        'status'=>'fail',
                        'type'=>'change'
                    ]
                );
            }
        }
        return view('externals.mail_forward_to_tm_manager',
            [
                'status'=>'error',
                'type'=>'change'
            ]
        );
    }

    public function mailBlockChecking(string $key)
    {
        $external = $this->access($key, 'outer-order-completed');
        if ($external) {
            if($external->status!=='error'){
                $external->click_at= Carbon::now();
                $external->save();
            }
            return view('externals.robot-check',
                [
                    'type'=>'메일 차단',
                    'key'=>$key
                ]
            );
        }
    }
    /**
     * 메일 수신 거부
     *
     * @param $key
     * @return External|External[]|bool|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function mailBlock(string $key)
    {
        $external = $this->access($key, 'outer-order-completed');
        if ($external) {
            if ($external->status==='0') {
                $subject = '[호텔에삶/수신차단필요]' . $external->hotel->email . '님';
                $data = [
                    'subject' => $subject,
                    'formatter'=> new Formatter()
                ];

                foreach ($this->admins as $index => $user) {
                    Mail::mailer('info')->send('emails.outer.confirmation_block', $data, function ($message) use ($user, $data) {
                        $message->to($user['email'], $user['name'])->subject($data['subject']);
                        $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                    });
                }

                $external->enter_at = Carbon::now();
                $external->status = '1';
                $external->memo = $external->hotel->email.' 해당 이메일 수신차단 요청';
                $external->save();

                return '호텔에삶 관리자에게 메일 수신 차단 전송했습니다.';
            }
            return '이미 처리가 완료되었습니다.';
        }
        return abort(404);
    }

    private function access($key, $type)
    {
        $external = External::whereAccessKey($key)->whereStatus('0')->whereType($type)->first();
        if($external){
            return $external;
        }

        $check = External::whereAccessKey($key)->whereStatus('1')->whereType($type)->first();
        if($check){
            return $check;
        }

        return view('externals.mail_forward_to_tm_manager',
            [
                'status'=>'error'
            ]
        );
    }
}
