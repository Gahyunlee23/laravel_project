<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotel;
use Livewire\Component;

class Core extends Component
{
    /* Request */
    public $tab;

    /* Data */
    public $addHotel;
    public $user;

    protected $listeners = [
        'HotelEntryTabChangeEvent',
    ];


    public function mount()
    {
        if (auth()->check()) {
            $this->user = auth()->user();
            if($this->addHotel===null){
                $this->addHotel = AddHotel::create([
                    'hotel_manager_id' => $this->user->id,
                    'enter_status' => '작성 중'
                ]);
            }
            //$this->dispatchBrowserEvent('https-url-state-change', ['tab' => $this->tab]);
        }
    }

    public function HotelEntryTabChangeEvent($type): void
    {
        if ($type === 'add') {
            $this->tab++;
        }
        if ($type === 'sub') {
            $this->tab--;
        }
        //$this->dispatchBrowserEvent('https-url-state-change', ['tab' => $this->tab]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.hotels.entry.core');
    }
}
