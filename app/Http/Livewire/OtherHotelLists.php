<?php

namespace App\Http\Livewire;

use App\Curator;
use Livewire\Component;

class OtherHotelLists extends Component
{
    public $curator_id;
    public $curator;
    public $other_hotels;
    public $hotel;

    public function mount(){
        if($this->hotel){
            $this->other_hotels=$this->hotel->other_hotels->toArray() ?? [17,3,11];
        }
        if($this->curator_id){
            $this->curator =Curator::find($this->curator_id);
        }
    }


    public function render()
    {
        return view('livewire.other-hotel-lists');
    }
}
