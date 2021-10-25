<?php

namespace App\Http\Livewire\Admin\Enter;

use App\AddHotelRoomType;
use App\AddHotelRoomTypeImage;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class RoomTypesEdit extends Component
{
    use WithFileUploads;
    /* Request */
    public $addHotel;

    /* Data */
    public $user;
    public $rules = [];
    public $messages = [];

    public $room_type;
    public $room_type_image_1 = [];
    public $room_type_image_2 = [];
    public $room_type_image_3 = [];
    public $room_type_name = [];
    public $room_type_main_explanation = [];
    public $room_type_sub_explanation = [];

    public $image_tmp;

    /* Alpine*/
    public $count;


    protected $listeners = [
        'RoomImagesRemoverEvent'
    ];

    public function mount(): void
    {
        $limit = 2;
        /* 최소 3개 세팅 - 홀수 : 룸 추가 버튼 까지 짝수*/
        if(auth()->check()){
            if(auth()->user()->hasPermissionTo('getListEnterHotel')){
                $this->user = User::find($this->addHotel->hotel_manager_id);
            }else{
                $this->user = auth()->user();
            }

            $this->dataLoad();
        }
    }

    public function dataLoad(){
        $addHotelRoomTypes= AddHotelRoomType::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->get();
        $addHotelRoomTypeImages = AddHotelRoomTypeImage::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->get();

        if($addHotelRoomTypes && $addHotelRoomTypeImages){

            $this->room_type_name[0] = '';
            $this->room_type_main_explanation[0] = '';
            $this->room_type_sub_explanation[0] = '';
            $this->room_type_image_1[0] = '';
            $this->room_type_image_2[0] = '';
            $this->room_type_image_3[0] = '';

            $this->room_type[]=null;
            foreach ($addHotelRoomTypes as $index=>$item){
                $this->room_type_name[$index+1] = $item->name;
                $this->room_type_main_explanation[$index+1] = $item->main_explanation;
                $this->room_type_sub_explanation[$index+1] = $item->sub_explanation;
                $this->room_type[$index+1] = $index+1;
            }
            foreach ($addHotelRoomTypeImages as $index=>$item){
                switch ($item->order) {
                    case '1':
                        $this->room_type_image_1[collect($this->room_type_image_1)->count()] = $item->image;
                        break;
                    case '2':
                        $this->room_type_image_2[collect($this->room_type_image_2)->count()] = $item->image;
                        break;
                    case '3':
                        $this->room_type_image_3[collect($this->room_type_image_3)->count()] = $item->image;
                        break;
                }
            }
        }
    }

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.enter.room-types-edit');
	}
}
