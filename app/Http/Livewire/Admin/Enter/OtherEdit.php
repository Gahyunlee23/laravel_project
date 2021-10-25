<?php

namespace App\Http\Livewire\Admin\Enter;

use App\AddHotelCheck;
use App\AddHotelOther;
use App\AddHotelTour;
use App\User;
use Livewire\Component;

class OtherEdit extends Component
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

    public function mount(){
        if(auth()->check()){
            if(auth()->user()->hasPermissionTo('getListEnterHotel')){
                $this->user = User::find($this->addHotel->hotel_manager_id);
            }else{
                $this->user = auth()->user();
            }
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
        usleep(100000);
        $this->emitUp('CoreEventOnLoaded');
    }
    public function checkTimerLoad(){
        $checks = AddHotelCheck::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->get();
        foreach ($checks as $index=>$check) {
            if($index===0){
                $this->check_time['start']=$check->start;
                $this->check_time['end']=$check->end;
            }
        }
        usleep(100000);
        $this->emitUp('CoreEventOnLoaded');
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.enter.other-edit');
	}
}
