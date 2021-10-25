<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotel;
use Livewire\Component;
use Livewire\WithFileUploads;

class Rooms extends Component
{
    use WithFileUploads;
    /* Request */
    public $addHotel;

    /* Data */
    public $room_1_image_1;
    public $room_1_image_2;
    public $room_1_image_3;

    public $room_1_name;
    public $room_1_main_explanation;
    public $room_1_sub_explanation;

    /* Alpine*/
    public $submitButton = false;


    protected $listeners = [
        'RoomImagesRemoverEvent'
    ];

    /* 이미지 삭제 처리*/
    public function RoomImagesRemoverEvent($target): void
    {
        $this->reset($target);
        $this->resetErrorBag($target);
    }


    public function rules(): array
    {
        return [
//            'name' => ['required', 'max:30'],
//            'area' => ['required', 'max:50'],
//            'subwayStation' => ['required', 'max:50'],
//            'images.*' => ['image', 'size:1024', 'max:1024', 'mimes:png,jpg,jpeg'],
            'room_1_image_1' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
            'room_1_image_2' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
            'room_1_image_3' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
        ];
    }

    public function messages(): array
    {
        return [
//            'name.required' => '호텔명 은(는) 필수 사항 입니다',
//            'name.max' => '호텔명 은(는) :max자 이내 입니다',
//            'area.required' => '호텔 주소 은(는) 필수 사항 입니다',
//            'area.max' => '호텔 주소 은(는) :max자 이내 입니다',
//            'subwayStation.required' => '호텔 근처 지하철역 은(는) 필수 사항 입니다',
//            'subwayStation.max' => '호텔 근처 지하철역 은(는) :max자 이내 입니다',

            'room_1_image_1.required' => '호텔 외관 이미지 은(는) 필수 사항 입니다',
            'room_1_image_1.image' => '호텔 외관 이미지 은(는) 이미지 파일만 가능 합니다',
            'room_1_image_1.max' => '호텔 외관 이미지 은(는) :max KB 이하 입니다',
            'room_1_image_1.mimes' => '호텔 외관 이미지 은(는) 확장자 png,jpg,jpeg 입니다',
            'room_1_image_2.required' => '호텔 외관 이미지 은(는) 필수 사항 입니다',
            'room_1_image_2.image' => '호텔 외관 이미지 은(는) 이미지 파일만 가능 합니다',
            'room_1_image_2.max' => '호텔 외관 이미지 은(는) :max KB 이하 입니다',
            'room_1_image_2.mimes' => '호텔 외관 이미지 은(는) 확장자 png,jpg,jpeg 입니다',
            'room_1_image_3.required' => '호텔 외관 이미지 은(는) 필수 사항 입니다',
            'room_1_image_3.image' => '호텔 외관 이미지 은(는) 이미지 파일만 가능 합니다',
            'room_1_image_3.max' => '호텔 외관 이미지 은(는) :max KB 이하 입니다',
            'room_1_image_3.mimes' => '호텔 외관 이미지 은(는) 확장자 png,jpg,jpeg 입니다',

        ];
    }

    public function updated($propertyName)
    {
        $this->submitButton = false;
        $this->validateOnly($propertyName);
        $this->submitButton = true;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.hotels.entry.rooms');
    }
}
