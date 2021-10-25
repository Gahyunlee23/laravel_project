<?php

namespace App\Http\Livewire\Hotel;

use App\Hotel;
use App\HotelRoom;
use Livewire\Component;

class AdditionalInformation extends Component
{
    protected $listeners = [
        'additionalInformationSetEvent','bodyOffsetWidthEvent',
        'additionalInformationSendHotelListsContainerPathsEvent',
        'additionalInformationFactoryEvent','render','clear'
    ];

    public $dev = false;
    public $show = false;

    public $hotel;
    public $reservation_type='month';
    public $room;
    public $hotel_id;
    public $room_id;

    public $width=640;

    public function additionalInformationFactoryEvent(): void
    {
        if($this->hotel_id){
            $this->hotel = Hotel::find($this->hotel_id);
        }
        if($this->room_id){
            $this->room = HotelRoom::find($this->room_id);
        }
    }

    public function clear($sleep): void
    {
        sleep($sleep);
        $this->setHotel(null);
        $this->setHotelId(null);
        $this->setRoom(null);
        $this->setRoomId(null);
    }

    public function render()
    {
        return view('livewire.hotel.additional-information');
    }

    public function additionalInformationSendHotelListsContainerPathsEvent($bool)
    {
        $this->show=$bool;
    }

    public function additionalInformationSetEvent($type,$data)
    {
        $this->$type=$data;
    }


    public function bodyOffsetWidthEvent($width)
    {
        $this->width=$width;
    }



    /**
     * @param mixed $hotel
     */
    public function setHotel($hotel): void
    {
        $this->hotel = $hotel;
    }

    /**
     * @param mixed $room
     */
    public function setRoom($room): void
    {
        $this->room = $room;
    }

    /**
     * @param mixed $hotel_id
     */
    public function setHotelId($hotel_id): void
    {
        $this->hotel_id = $hotel_id;
    }

    /**
     * @param mixed $room_id
     */
    public function setRoomId($room_id): void
    {
        $this->room_id = $room_id;
    }
}
