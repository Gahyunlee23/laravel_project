<?php

namespace App\Http\Livewire\Hotel;

use App\Hotel;
use App\HotelRoom;
use Illuminate\Support\Str;
use Livewire\Component;

class RoomOptionSelect extends Component
{
    protected $listeners = [
        'roomOptionSelectSetDataEvent'=>'setData'
        ,'roomOptionSelectSetHotelEvent'=>'setHotel'
        ,'roomOptionSelectSetHotelRoomEvent'=>'setHotelRoom'
    ];

    public $hotel;
    public $hotel_room;
    public $hotel_id;
    public $room_id;
    public $hotel_type;
    public $hotelType;
    public $room_option_select;
    public $room_option_select_upgrade;
    public $room_options;
    public $room_upgrades;
    public $room_option_upgrades;
    public $room_sold_outs;

    public function roomSelect($room_id,$room_upgrade_id=''): void
    {
        $this->room_option_select=$room_id;
        $this->room_option_select_upgrade=$room_upgrade_id;
        $this->dispatchBrowserEvent('room-type-select-id', [
            'roomTypeId' => $this->room_option_select,
            'roomTypeUpgradeId'=>$this->room_option_select_upgrade
        ]);
    }

    public function setData($type,$data): void
    {
        $this->$type=$data;
    }
    public function setHotel($data): void
    {
        $this->hotel=Hotel::find($data);
    }
    public function setHotelRoom($data): void
    {
        $this->room_option_upgrades=null;
        $this->hotel_room=HotelRoom::find($data);
        if($this->hotel_room){
            $this->room_options = Str::of($this->hotel_room->room_option)->explode(',')->filter(function ($item){
                return $item ?? null;
            });
            $this->room_upgrades = Str::of($this->hotel_room->room_upgrade)->explode(',')->filter(function ($item) {
                return $item ?? null;
            });
            foreach ($this->room_upgrades as $index=>$room_upgrade) {
                if( $room_upgrade !==null && !empty($room_upgrade)){
                    $this->room_option_upgrades[] = ($room_upgrade);
                }
            }
            $this->room_sold_outs = Str::of($this->hotel_room->room_sold_out)->explode(',')->filter(function ($item) {
                return $item ?? null;
            });
            if(isset($this->room_options[0]) && !empty($this->room_options[0])){
                foreach ($this->room_options as $room_option){
                    if(in_array($room_option, $this->room_sold_outs->toArray())){
                        continue;
                    }
                    $this->room_option_select=$room_option;
                    if(isset($this->room_upgrades[0]) && !empty($this->room_upgrades[0])){
                        $this->room_option_select_upgrade=$this->room_upgrades[0];
                    }
                    $this->dispatchBrowserEvent('room-type-select-id', [
                        'roomTypeId' => $this->room_option_select,
                        'roomTypeUpgradeId'=>$this->room_option_select_upgrade ?? ''
                    ]);
                    break;
                }
            }
        }
    }
    public function render()
    {
        return view('livewire.hotel.room-option-select');
    }
}
