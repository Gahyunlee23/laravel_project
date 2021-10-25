<?php

namespace App\Http\Livewire\Hotels\Managers;

use Livewire\Component;

class HotelTab extends Component
{
    /* Request */

    /* Response */

    /* Data */

    /* Alpine */
    public $tab;

//    protected $listeners = [
//        'managerHotelTab'
//    ];

    public function managerHotelTab($index): void
    {
        $this->tab=$index;
        $this->emitTo('hotels.managers.core-board', 'CoreBoardTabChange', ['tab'=> $index]);
    }

	public function render()
	{
		return view('livewire.hotels.managers.hotel-tab');
	}
}
