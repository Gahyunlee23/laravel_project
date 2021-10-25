<?php

namespace App\Http\Livewire\Admin\Curator;

use App\CuratorHotel;
use App\Hotel;
use Livewire\Component;

class HotelInterlock extends Component
{
    /* Request */
    public $curator;

    /* Data */
    public $hotels = [];
    public $curator_hotels;
    public $checked_hotel;
    public $check_hotel;

    public $remove;
    public $push;

    /* Alpine*/
    protected $listeners = [
        'curatorHotelImport',
        'hotelInterlockSubmit'
    ];

    public function mount()
    {
        $this->checkingHotelReset();
    }

    public function checkingHotelReset()
    {
        $this->checked_hotel = collect();
        $this->check_hotel = collect();
        $this->remove = collect();
        $this->push = collect();
    }

    public function curatorHotelImport()
    {
        $this->curatorHotelsGet();
        $this->hotels = Hotel::where('curator', '=', 'Y')->where('status', '=', '2')->get();

        $this->checkingHotelReset();
        $this->curatorHotelsCheck();
    }

    public function curatorHotelsGet()
    {
        $this->curator_hotels = CuratorHotel::where('curator_id', '=', $this->curator->id)->get();
    }

    public function checkboxCheckedChange($index, $findId)
    {
        if ($this->check_hotel[$index]['bool']) {
            CuratorHotel::create([
                'hotel_id' => $findId,
                'curator_id' => $this->curator->id
            ]);
        } else {
            $curatorHotel = CuratorHotel::where('curator_id', '=', $this->curator->id)->where('hotel_id', '=', $findId)->first();
            CuratorHotel::find($curatorHotel->id)->delete();
        }
    }

    public function curatorHotelsCheck(): void
    {
        foreach ($this->hotels as $hotel) {
            if ($this->curator_hotels->pluck('hotel_id')->contains($hotel->id)) {
                $this->checked_hotel->push([
                    'id'=>$hotel->id,
                    'bool'=>true
                ]);
            }else{
                $this->checked_hotel->push([
                    'id'=>$hotel->id,
                    'bool'=>false
                ]);
            }
        }
        $this->check_hotel = $this->checked_hotel;
    }

    public function render()
    {
        return view('livewire.admin.curator.hotel-interlock');
    }
}
