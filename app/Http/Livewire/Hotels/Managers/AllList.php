<?php

namespace App\Http\Livewire\Hotels\Managers;

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
use App\NoShow;
use App\Payment;
use App\Template;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class AllList extends Component
{
    use WithPagination;

    /* Request */
    public $user;
    public $menuIndex;
    public $list = 'all-list';

    /* Response */
    public $currentPage;
    public $search = '';
    public $order_names = '';
    public $flitter;
    public $hotel_index;

    public $date_option = 'confirmation';
    public $flitter_date_start;
    public $flitter_date_end;

    /* Data */
    public $hotel;

    /* Alpine */
    public $sortField = 'updated_at';
    public $sortAsc = true;
    public $detail_reservation;

    protected $listeners = [
        'hotelReload', 'hotelReloadList',
        'ListEventFlitterReset' => 'flitterReset',
        'ListEventResetFlitterDate'=>'resetFlitterDate'
    ];

    public function mount($hotelTab): void
    {
        $this->hotel_index = $hotelTab;
        $this->user = auth()->user();
        $this->hotel = $this->user->HotelManagers->get($hotelTab)->hotel;

        if (Session::has('flitter')) {
            $this->flitter = Session::get('flitter');
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->getOrderNames();
    }

    public function updatedDateOption(): void
    {
        $this->resetFlitterDate();
    }

    public function resetFlitterDate()
    {
        $this->reset('flitter_date_start', 'flitter_date_end');
    }

    public function updatedFlitterDateStart(): void
    {
        $this->render();
    }

    public function updatedFlitterDateEnd(): void
    {
        $this->render();
    }

    public function getOrderNames(): void
    {
        $this->reset('order_names');
        if ($this->search !== '' && $this->search !== null) {
            $this->order_names = $this->dataLoad()->groupBy('order_name')->get()->pluck('order_name');
        }
    }

    public function openDetailModal($reservation_id): void
    {
        $this->detail_reservation = HotelReservation::find($reservation_id);
        $this->gotoPage($this->currentPage);
    }

    public function searchExampleClick($index): void
    {
        $this->search = $this->order_names[$index];
        $this->reset('order_names');
    }

    public function hotelReload($index): void
    {
        $this->hotel_index = $index;
        $this->hotel = $this->user->HotelManagers->get($index)->hotel;
        $this->emitTo('hotels.managers.menu-tab', 'menuTabChange', 0);
        $this->emitSelf('render');
    }

    public function hotelReloadList($list): void
    {
        $this->list = $list;
        $this->emitSelf('render');
    }

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function flitterReset(): void
    {
        $this->flitter = '';
        Session::remove('flitter');
    }

    public function dataLoad()
    {
        return HotelReservation::where('hotel_id', '=', $this->hotel->id)
            ->where(function ($query) {
                if ($this->list === 'month-list') {
                    $query->where('type', '=', 'month')
                        ->whereIn('order_status', ['3', '5', '0', '10', '11']);
                } elseif ($this->list === 'tour-list') {
                    $query->where('type', '=', 'tour')
                        ->whereIn('order_status', ['2', '3', '5', '0']);
                } else {
                    $query->orWhere(function ($query) {
                        $query->whereIn('order_status', ['3', '5', '0', '10', '11'])
                            ->where('type', '=', 'month');
                    })
                        ->orWhere(function ($query) {
                            $query->whereIn('order_status', ['2', '3', '5', '0'])
                                ->where('type', '=', 'tour');
                        });
                }
            })
            ->where(function ($query) {
                /*$query->where('user_id', '!=', '4')
                    ->where('order_name', '!=', '테스트');*/
                if ($this->search !== '' && $this->search !== null) {
                    $query->where('order_name', 'like', '%' . $this->search . '%');
                }
            })
            ->where(function ($query) {
                if ($this->flitter !== '' && $this->flitter !== null) {
                    $query->statusFlitter($this->flitter);
                }
            })
            ->where(function ($query) {
                if ($this->date_option !== '' && $this->date_option !== null
                    && $this->flitter_date_start !== '' && $this->flitter_date_start !== null
                    && auth()->user()->hasAnyRole('개발')) {
                    switch ($this->date_option) {
                        case 'confirmation' :
                            $query->where(function ($q) {
                                $q->where('type', '=', 'month')
                                    ->whereHas('confirmation', function ($q) {
                                        if ($this->flitter_date_start !== '' & $this->flitter_date_start !== null) {
                                            $q->where('status', '=', '1')->where('start_dt', '>=', $this->flitter_date_start);
                                        }
                                        if ($this->flitter_date_end !== '' & $this->flitter_date_end !== null) {
                                            $q->where('status', '=', '1')->where('end_dt', '<=', Carbon::parse($this->flitter_date_end)->addDay());
                                        }
                                    });
                            });
                            break;
                        case 'payment' :
                            $query->where(function ($q) {
                                if ($this->flitter_date_start !== '' & $this->flitter_date_start !== null) {
                                    $q->where('type', '=', 'month')->whereDate('order_desired_dt', $this->flitter_date_start);
                                }
                            });
                            break;

                    }
                }
            })
            ->orderBy($this->sortField, $this->sortAsc ? 'desc' : 'asc');
    }

    public function resetPage(): void
    {
        $this->currentPage = 1;
    }

    public function nextPage(): void
    {
        ++$this->currentPage;
        $this->pageResolver();
    }

    public function previousPage(): void
    {
        --$this->currentPage;
        $this->pageResolver();
    }

    public function gotoPage($page): void
    {
        $this->currentPage = $page;
        $this->pageResolver();
        //Session::flash('message', '');
    }

    public function checkPage(): void
    {
        if ($this->currentPage !== null) {
            $this->pageResolver();
        }
    }

    protected function pageResolver(): void
    {
        session(['currentPage' => $this->currentPage]);
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });

        $this->emitSelf('render');
        $this->dispatchBrowserEvent('custom-event-page-change');
        //$this->dispatchBrowserEvent('menuTabClickEvent', ['hotel_index' => $this->hotel_index, 'menu_index'=>$this->menuIndex]);
    }

    public function flitterChange(): void
    {
        Session::put('flitter', $this->flitter);
        $this->emitSelf('render');
    }

    public function reservationStatus($reservation_id, $type)
    {
        $reservation = HotelReservation::find($reservation_id);
        if ($reservation) {

            if ($type === '확정') {
                /* 날자 지났을 경우 체크 */
//                if($reservation){
//                    Session::put('result' , 'test');
//                    return false;
//                }
                if (isset($reservation->external)) {
                    $this->confirmation($reservation->external->access_key);
                }else{
                    Session::put('result' , '외부 승인 정보 Error, 호텔에삶 관리자에게 문의 해주세요.');
                }
            } elseif ($type === '변경 필요') {
                if (isset($reservation->external)) {
                    $this->confirmationChange($reservation->external->access_key);
                }else{
                    Session::put('result' , '외부 승인 정보 Error, 호텔에삶 관리자에게 문의 해주세요.');
                }
            } elseif ($type === 'no-show') {
                $noShow = NoShow::create([
                    'reservation_id'=>$reservation->id,
                    'confirmation_id'=>$reservation->confirmation ?? null,
                    'hotel_id'=>$reservation->hotel->id ?? null,
                    'user_id'=>$reservation->user_id ?? null,
                    'hotel_manager_id'=>auth()->user()->id ?? null,
                ]);

                $admins = [
                    [
                        'email'=>'hotelmanager@travelmakers.kr',
                        'name'=>'TM관리자'
                    ]
                ];
                $data = [
                    'noShow'=>$noShow
                ];
                foreach ($admins as $index => $email) {
                    Mail::mailer('info')->send('emails.admin.no-show', $data, function ($message) use ($email, $reservation) {
                        $message->to($email['email'], $email['name'])->subject('[호텔에삶/투어/노쇼]'.$reservation->order_name.'님 '.$reservation->hotel->option->title);
                        $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                    });
                }
                Session::put('result' , 'No Show 처리 완료 했습니다.');
            }
            return redirect()->route('hotel-manager.dash-board', ['tab' => $this->hotel_index, 'list' => $this->list]);
        }
    }

    public function confirmation($key)
    {
        $external = $this->access($key, 'outer-order-completed');
        if ($external) {
            if ($external->status === '0') {
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

                        if ($reservation->confirmations->count() >= 2) {
                            $beforeConfirmation = $reservation->confirmations->get($reservation->confirmations->count() - 2);
                            $confirmation = $reservation->confirmations->get($reservation->confirmations->count() - 1);
                            if (isset($confirmation) &&
                                ($beforeConfirmation->start_dt !== $confirmation->start_dt
                                    || $beforeConfirmation->end_dt !== $confirmation->end_dt)) {
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
                            'formatter' => $formatter
                        ];
                        if (auth()->check() && auth()->user()->hasAnyRole('개발')) {
                            foreach ($reservation->hotel->admin_emails as $index => $email) {
                                Mail::mailer('info')->send('emails.outer.confirmation', $data, function ($message) use ($email, $data) {
                                    $message->to($email, '트메 관리자')->subject($data['subject']);
                                    $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                                });
                            }
                        } else {
                            foreach ($this->admins as $index => $user) {
                                Mail::mailer('info')->send('emails.outer.confirmation', $data, function ($message) use ($user, $data) {
                                    $message->to($user['email'], $user['name'])->subject($data['subject']);
                                    $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                                });
                            }
                        }

                        $external->enter_at = Carbon::now();
                        $external->status = '1';
                        $external->memo = $reservation->order_name . '님 입주 확정 필요 요청';
                        $external->save();

                        Session::put('result' , '호텔에삶 관리자에게 확정 가능 전달 되었습니다.');
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
                                    $template_content = $formatter->templateFormat($template->template, [
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
                                        'formatter' => $formatter
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
                                    $external->memo = $reservation->order_name . '님 투어 확정 완료';
                                    $external->save();
                                    $reservation->order_status = 5;
                                    $reservation->save();

                                    $confirmation = Confirmation::updateOrCreate(
                                        [
                                            'type' => 'HotelTour',
                                            'reservation_id' => $reservation->id
                                        ],
                                        [
                                            'type' => 'HotelTour',
                                            'reservation_id' => $reservation->id,
                                            'start_dt' => Carbon::parse($reservation->order_desired_dt)->format('Y-m-d H:i:s'),
                                            'end_dt' => null,
                                            'memo' => $reservation->order_name . '님 투어 확정 완료',
                                            'status' => '1'
                                        ]);

                                    AlertTalkList::create([
                                        'template_id' => $template->id ?? null,
                                        'reservation_id' => $reservation->id,
                                        'payment_id' => $payment->id ?? null,
                                        'confirmation_id' => $confirmation->id,
                                        'hotel_id' => $reservation->hotel->id,
                                        'room_id' => $hotel_room->id ?? null,
                                        'catalog' => $template->catalog ?? null,
                                        'hp' => $formatter->hpFormat($reservation->order_hp),
                                        'result' => 'success',
                                        'template' => $template_content,
                                        'send_at' => Carbon::now(),
                                    ]);

                                    $data = [
                                        'subject' => '[호텔에삶]' . $reservation->order_name . '님 투어 확정되었습니다.',
                                        'type' => '확정',
                                        'name' => $reservation->order_name,
                                        'reservation' => $reservation,
                                        'hotel' => $hotel ?? null,
                                        'hotel_option' => $hotel_option ?? null,
                                        'room' => $hotel_room ?? null,
                                        'payment' => $payment ?? null,
                                        'external' => $external,
                                        'formatter' => $formatter
                                    ];
                                    /*투어확정*/
                                    if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                                        foreach ($reservation->hotel->admin_emails as $index => $email) {
                                            Mail::mailer('info')->send('emails.outer.order_completed_confirmation', $data, function ($message) use ($email, $data) {
                                                $message->to($email, '호텔 관리자님')->subject($data['subject']);
                                                $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                                            });
                                        }
                                    }else{
                                        foreach ($hotel->tour_emails as $index => $email) {
                                            Mail::mailer('hotel-manager')->send('emails.outer.order_completed_confirmation', $data, function ($message) use ($email, $data) {
                                                $message->to($email, '호텔 관리자님')->subject($data['subject']);
                                                $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'), env('HOTEL_MANAGER_MAIL_NICKNAME'));
                                            });
                                        }
                                    }
                                    Session::put('result' , '투어 확정 처리, 고객 알림톡 전달 되었습니다.');
                                }
                                Session::put('result' , '투어 확정 Error, 호텔에삶 관리자에게 연락해주세요.');
                            }
                            Session::put('result' , '이미 투어 확정 or 변경 처리 완료했습니다.');
                        }
                        Session::put('result' , '투어 확정 External Error, 호텔에삶 관리자에게 연락해주세요.');
                    }
                }else{
                    Session::put('result' , '주문 정보 Error, 호텔에삶 관리자에게 연락해주세요.');
                }
            }else{
                Session::put('result' , '해당 주문은 이미 처리 완료했습니다.');
            }
        }
    }

    public function confirmationChange($key)
    {
        $external = $this->access($key, 'outer-order-completed');
        if($external){
            if ($external->status==='0') {
                $reservation = HotelReservation::find($external->reservation_id);
                if ($reservation) {

                    $hotel = \App\Hotel::whereId($reservation->hotel_id)->whereStatus('2')->first();
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

                    Session::put('result' , '호텔에삶 관리자에게 변경 필요 전달 되었습니다.');
                }
            }else if ($external->status==='1') {
                Session::put('result' , '이미 확정 or 변경 처리 완료했습니다.');
            }
        }else{
            Session::put('result' , '변경 필요 External Error, 호텔에삶 관리자에게 연락해주세요.');
        }
    }

    private function access($key, $type)
    {
        $external = External::whereAccessKey($key)->whereStatus('0')->whereType($type)->first();
        if ($external) {
            return $external;
        }

        $check = External::whereAccessKey($key)->whereStatus('1')->whereType($type)->first();
        if ($check) {
            return $check;
        }
    }

    public function render()
    {
        $reservations = $this->dataLoad()->paginate(10);
        return view('livewire.hotels.managers.all-list', [
            'reservations' => $reservations
        ]);
    }
}
