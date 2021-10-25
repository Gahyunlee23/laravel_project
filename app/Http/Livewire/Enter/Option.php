<?php

namespace App\Http\Livewire\Enter;

use App\EnterOption;
use Livewire\Component;

class Option extends Component
{
    protected $listeners = ['option_store'=>'store','option_checker'=>'checker'];

    public $amenities;
    public $facilities;
    public $benefit;

    public function render()
    {
        return view('livewire.enter.option');
    }

    public function checker()
    {
        if($this->amenities === null || $this->facilities === null || $this->benefit === null){
            $this->dispatchBrowserEvent('alert', ['type' => 'room','message'=>'호텔 옵션을 모두 입력 후 신청해주세요.']);
            $this->dispatchBrowserEvent('option-checker', ['data' => false]);
        }else{
            $this->dispatchBrowserEvent('option-checker', ['data' => true]);
        }
    }

    public function store($enter_id): void
    {
        EnterOption::create([
            'enter_id'=>$enter_id,
            'amenities' => $this->amenities,
            'facilities' => $this->facilities,
            'benefit' => $this->benefit
        ]);
    }
}
