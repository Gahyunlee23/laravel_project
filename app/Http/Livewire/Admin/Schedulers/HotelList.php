<?php

namespace App\Http\Livewire\Admin\Schedulers;

use App\Hotel;
use Livewire\Component;

class HotelList extends Component
{
    /* Request */
    public $hotels;

    /* Alpine */
    public $curator = false;

    public function mount() {
        $this->dataLoad();
    }

    public function curatorShow($bool) {
        $this->curator = $bool;
        $this->dataLoad();
    }

    public function dataLoad(){
        $hotels=Hotel::where('status', '!=', '0');
        if($this->curator){
            $hotels = $hotels->where('curator', '=', 'Y');
        }else{
            $hotels = $hotels->where('curator', '=', 'N');
        }
        $this->hotels = $hotels->get();
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.schedulers.hotel-list');
	}
}
