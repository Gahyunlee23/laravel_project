<?php

namespace App\Http\Livewire\Admin\Enter;

use App\AddHotelAmenity;
use App\AddHotelFacility;
use App\User;
use Livewire\Component;

class AmenitiesFacilitiesEdit extends Component
{
    /* Request */
    public $addHotel;
    public $user;

    /* Input */
    public $amenity;
    public $amenities;
    public $amenities_tmp;

    public $without_amenity;
    public $without_amenities;
    public $without_amenities_tmp;

    public $facility_limit = 8;
    public $facility;
    public $facilities;

    public function mount(){
        if(auth()->check()){
            if(auth()->user()->hasPermissionTo('getListEnterHotel')){
                $this->user = User::find($this->addHotel->hotel_manager_id);
            }else{
                $this->user = auth()->user();
            }
        }
    }

    public function amenityInit()
    {
        $this->amenities = AddHotelAmenity::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->whereNull('without')
            ->pluck('name');
    }
    public function withoutAmenityInit()
    {
        $this->without_amenities = AddHotelAmenity::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->whereWithout(1)
            ->pluck('name');
    }
    public function facilityInit()
    {
        $this->facilities = AddHotelFacility::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)->get();

        foreach ($this->facilities as $item){
            $this->facility[] = ['name'=>$item['name'], 'explanation'=>$item['explanation']];
        }
        if($this->facilities->count()===0){
            $this->facility = [''];
        }
    }
	/**
	 * Get the view / contents that represent the component
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.enter.amenities-facilities-edit');
	}
}
