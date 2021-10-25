<?php

namespace App\Http\Livewire\Enter;

use App\Enter;
use Livewire\Component;

class Hotel extends Component
{
    protected $listeners = ['hotel_store'=>'store','hotel_checker'=>'checker'];

    public $hotel_name;
    public $hotel_address;
    public $hotel_web_address;

    public function render()
    {
        return view('livewire.enter.hotel');
    }


    public function checker()
    {
        if($this->hotel_name === null || $this->hotel_address === null || $this->hotel_web_address === null ){
            $this->dispatchBrowserEvent('alert', ['type' => 'hotel','message'=>'호텔 정보를 모두 입력 후 신청해주세요.']);
            $this->dispatchBrowserEvent('hotel-checker', ['data' => false]);
        }else{
            $this->dispatchBrowserEvent('hotel-checker', ['data' => true]);
        }
    }
    public function store()
    {
        if($this->hotel_name === null || $this->hotel_address === null || $this->hotel_web_address === null ){
            $this->dispatchBrowserEvent('alert', ['type' => 'hotel','message'=>'호텔 정보를 모두 입력 후 신청해주세요.']);
            return false;
        }
        $enter = Enter::create([
            'hotel_name' => $this->hotel_name,
            'hotel_address' => $this->hotel_address,
            'hotel_web_address' => $this->hotel_web_address
        ]);
        $this->dispatchBrowserEvent('hotel-created', ['data' => $enter->id]);
    }
}
