<?php

namespace App\Http\Livewire\Admin\Enter;

use App\AddHotelCheckPoint;
use App\AddHotelImage;
use App\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class HotelImagesAndCheckPointsEdit extends Component
{
    use WithFileUploads;

    /* ORM */
    public $addHotel;
    public $user;
    public $addHotelImage1;
    public $addHotelImage2;
    public $addHotelImage3;
    public $addHotelImage4;
    public $addHotelImage5;
    public $addHotelImage6;

    /* Validate */
    public $rules;

    /* Data*/
    public $imageIndex=1;

    public $hotelImage1;
    public $hotelImage2;
    public $hotelImage3;

    public $hotelImageOptional1;
    public $hotelImageOptional2;
    public $hotelImageOptional3;

    public $name;
    public $area;
    public $subwayStation;

    public $checkpointImage1;
    public $checkpointTitle1;
    public $checkpointExplanation1;

    public $checkpointImage2;
    public $checkpointTitle2;
    public $checkpointExplanation2;

    public $checkpointImage3;
    public $checkpointTitle3;
    public $checkpointExplanation3;

    /*Alpine*/
    public $submitButton = false;

    protected $listeners = [
        'hotelImagesRemoverEvent'
    ];

    public function mount()
    {
        if(auth()->check()){
            if(auth()->user()->hasPermissionTo('getListEnterHotel')){
                $this->user = User::find($this->addHotel->hotel_manager_id);
            }else{
                $this->user = auth()->user();
            }

            if($this->addHotel->name !== null){
                $this->name = $this->addHotel->name;
            }
            if($this->addHotel->area !== null){
                $this->area = $this->addHotel->area;
            }
            if($this->addHotel->subway_station !== null){
                $this->subwayStation = $this->addHotel->subway_station;
            }
            if($this->addHotel->area !== null){
                $this->area = $this->addHotel->area;
            }

            $addHotelImage = AddHotelImage::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->get();
            if($addHotelImage){
                $addHotelImage->each(function ($item, $key){
                    switch ($item->order) {
                        case '1':
                            $this->hotelImage1 = $item->image;
                            break;
                        case '2':
                            $this->hotelImage2 = $item->image;
                            break;
                        case '3':
                            $this->hotelImage3 = $item->image;
                            break;
                        case '4':
                            $this->hotelImageOptional1 = $item->image;
                            break;
                        case '5':
                            $this->hotelImageOptional2 = $item->image;
                            break;
                        case '6':
                            $this->hotelImageOptional3 = $item->image;
                            break;
                    }
                });
            }

            $addHotelICheckPoint = AddHotelCheckPoint::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->get();
            if($addHotelICheckPoint){
                $addHotelICheckPoint->each(function ($item, $key){
                    switch ($item->order) {
                        case '1':
                            $this->checkpointImage1 = $item->image;
                            $this->checkpointTitle1 = $item->title;
                            $this->checkpointExplanation1 = $item->explanation;
                            break;
                        case '2':
                            $this->checkpointImage2 = $item->image;
                            $this->checkpointTitle2 = $item->title;
                            $this->checkpointExplanation2 = $item->explanation;
                            break;
                        case '3':
                            $this->checkpointImage3 = $item->image;
                            $this->checkpointTitle3 = $item->title;
                            $this->checkpointExplanation3 = $item->explanation;
                            break;
                    }
                });
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
		return view('livewire.admin.enter.hotel-images-and-check-points-edit');
	}
}
