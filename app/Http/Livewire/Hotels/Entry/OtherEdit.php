<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotelCheck;
use App\AddHotelNeedToModify;
use App\AddHotelOther;
use App\AddHotelTour;
use Illuminate\Support\Str;
use Livewire\Component;

class OtherEdit extends Component
{
    /* Request */
    public $addHotel;
    public $edit;

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

    protected $listeners = [
        'otherEditEvent'=>'submit'
    ];

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
                $this->tour_time['start']=$tour->start ?? '10:00';
                $this->tour_time['end']=$tour->end ?? '18:00';
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
        $this->tour_day=collect($this->tour_day)->filter(function($item){
            return $item!==false;
        });

        $this->validate();

        $this->managerSave();
        $this->tourSave();
        $this->checkTimeSave();

        $this->emitUp('coreAndSubmit');
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
        $model = 'AddHotelOther';
        if(Str::of($propertyName)->contains('tour')){
            $model = 'AddHotelTour';
        }
        if(Str::of($propertyName)->contains('check')){
            $model = 'AddHotelCheck';
        }
        AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)->whereModel($model)->whereTarget($propertyName)->whereNull('status')->update([
            'status'=>'확인'
        ]);
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.hotels.entry.other-edit');
	}
}
