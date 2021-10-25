<?php

namespace App\Http\Livewire\Admin\Hotels;

use Livewire\Component;

class OtherHotelList extends Component
{
    /* Request */
    public $hotel;
    public $test;

    /* Data */
    public $otherHotelList;
    public $otherHotelLists;

    public function orderListGet(){
        if($this->hotel){
            foreach ($this->hotel->OtherHotels as $otherHotel) {
                $this->otherHotelList[] = $otherHotel;
            }
        }
    }

    public function otherHotelListSubmit(){

        if(collect($this->otherHotelLists)->count()>=1){
            $this->hotel->other_hotel = collect($this->otherHotelLists)->implode(',');
            $this->hotel->save();
        }

    }

    public function otherHotelAdd($id){
        $this->otherHotelLists[]=$id;
    }

    public function hotelListRemove($index)
    {
        $this->otherHotelLists = collect($this->otherHotelLists)->forget($index);
    }
    public function updatedOtherHotelList($value,$key){
        if($value){
            $this->otherHotelLists[]=$value;
        }
    }

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.hotels.other-hotel-list');
	}
}
