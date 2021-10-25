<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotelCheck;
use App\AddHotelOption;
use App\AddHotelOther;
use App\AddHotelTour;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Other extends Component
{
    /* Request */
    public $addHotel;

    public $user;
    /* Input */
    public $name;
    public $phone_number;
    public $department_name;
    public $department_position;

    public $tour_day;
    public $tour_time;

    public $check_time;

    public $dates = ['일','월','화','수','목','금','토'];

    public $rules = [
        'name' => ['required', 'max:20'],
        'phone_number' => ['required', 'max:15', 'phone:KR'],
        'department_name' => ['required', 'max:20', 'min:2'],
        'department_position' => ['required', 'max:20', 'min:2'],
        'tour_day'=>['required','array','min:2'],
        'tour_time.start' => ['required'],
        'tour_time.end' => ['required', 'after:tour_time.start'],
        'check_time.start' => ['required'],
        'check_time.end' => ['required'],
    ];

    public $messages = [
        'phone_number.phone' => '휴대전화 번호 형식으로 입력해주세요',
        'tour_time.end.after' => '체크인 시간 이후 입니다',
   ];

    public function mount(){
        if(auth()->check()){
            $this->user = auth()->user();

            $this->tour_time['start']='10:00';
            $this->tour_time['end']='18:00';
            $this->check_time['start']='14:00';
            $this->check_time['end']='12:00';
        }
    }

    public function managerLoad(){
        $other = AddHotelOther::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->latest()->first();
        $this->name = $other->name ?? '';
        $this->phone_number = $other->phone_number ?? '';
        $this->department_name = $other->department_name ?? '';
        $this->department_position = $other->department_position ?? '';
    }
    public function tourLoad(){
        $tours = AddHotelTour::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->get();
        foreach ($tours as $index=>$tour) {
            $this->tour_day[collect($this->dates)->search($tour->day)]=$tour->day;
            if($index===0){
                $this->tour_time['start']=$tour->start;
                $this->tour_time['end']=$tour->end;
            }
        }
    }
    public function checkTimerLoad(){
        $checks = AddHotelCheck::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->get();
        foreach ($checks as $index=>$check) {
            if($index===0){
                $this->check_time['start']=$check->start;
                $this->check_time['end']=$check->end;
            }
        }
    }

    public function managerSave()
    {
        AddHotelOther::updateOrCreate([
            'add_hotel_id'=>$this->addHotel->id,
            'hotel_manager_id'=>$this->user->id,
        ],[
            'add_hotel_id'=>$this->addHotel->id,
            'hotel_manager_id'=>$this->user->id,
            'name'=>$this->name,
            'phone_number'=>$this->phone_number,
            'department_name'=>$this->department_name,
            'department_position'=>$this->department_position,
        ]);
    }
    public function tourSave()
    {
        AddHotelTour::onlyTrashed()->whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->forceDelete();
        AddHotelTour::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->delete();
        foreach ($this->tour_day as $day){
            AddHotelTour::create([
                'add_hotel_id'=>$this->addHotel->id,
                'hotel_manager_id'=>$this->user->id,
                'day'=>$day,
                'start'=>$this->tour_time['start'] ?? null,
                'end'=>$this->tour_time['end'] ?? null
            ]);
        }
    }
    public function checkTimeSave()
    {
        AddHotelCheck::onlyTrashed()->whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->forceDelete();
        AddHotelCheck::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->delete();
        foreach ($this->tour_day as $day){
            AddHotelCheck::create([
                'add_hotel_id'=>$this->addHotel->id,
                'hotel_manager_id'=>$this->user->id,
                'date'=>null,
                'start'=>$this->check_time['start'] ?? null,
                'end'=>$this->check_time['end'] ?? null
            ]);
        }
    }

    public function submit()
    {
        $loadingDate = now();

        $this->tour_day=collect($this->tour_day)->filter(function($item){
            return $item!==false;
        });

        $this->validate();

        $this->managerSave();
        $this->tourSave();
        $this->checkTimeSave();

        if($loadingDate->diffInRealMicroseconds(now()) <= 500000){
            usleep(500000-$loadingDate->diffInRealMicroseconds(now()));
        }
        if($this->addHotel->enter_status === '작성 중'){
            $this->addHotel->enter_status = '심사 대기';
            $this->addHotel->save();
            /* TM 관리자 메일 전송 */
            $admins = [
                [
                    'email'=>env('APPLY_MAIL_USERNAME') ?? 'hotelmanager@travelmakers.kr',
                    'name'=>env('APPLY_MAIL_NICKNAME') ?? '트래블메이커스'
                ],
                [
                    'email'=>'hotelmanager@travelmakers.kr',
                    'name'=>'트래블메이커스'
                ],
                [
                    'email'=>'travelmakerkorea_k@naver.com',
                    'name'=>'김병주'
                ]
            ];
            $data = [
                'subject'=>'[호텔에삶>입점신청>심사대기]'.($this->addHotel->name ?? '정보 없음').', 심사 필요',
                'addHotel'=>$this->addHotel
            ];
            foreach ($admins as $index => $user){
                Mail::mailer('apply')->send('emails.enter.waiting-for-review', $data, function($message) use ($user,$data) {
                    $message->to($user['email'],$user['name'])->subject($data['subject']);
                    $message->from(env('APPLY_MAIL_USERNAME'), env('APPLY_MAIL_NICKNAME'));
                });
            }
        }
        session()->flash('message', '<div class="font-bold">[입점 신청 완료]</div>입점 신청이 완료되었습니다.<br>입점 승인 결과는 영업일 기준 14일 내로<br>현재 페이지와 가입 시 입력한 이메일로 안내됩니다.');
        return redirect()->route('hotel-manager.hotel-management');
    }

    public function backRedirect($tab)
    {
        return redirect()->route('hotel-entry.hotel',['hotel'=>$this->addHotel->id,'tab' => $tab]);
    }
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.hotels.entry.other');
    }
}
