<?php

namespace App\Http\Livewire\Admin\Hotels;

use Livewire\Component;

class OrderHotelList extends Component
{
    /* Request */
    public $hotel;
    public $test;

    /* Data */
    public $otherHotelList;

    public function orderListGet(){
        if($this->hotel){
            $this->otherHotelList = $this->hotel->OtherHotels;
        }
    }
    public function orderHotelListSubmit(){
        ddd($this->hotel,$this->hotel->OtherHotels,$this->otherHotelList);
    }

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.hotels.order-hotel-list');
	}
}
