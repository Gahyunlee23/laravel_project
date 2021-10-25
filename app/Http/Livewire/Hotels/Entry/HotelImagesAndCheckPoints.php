<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotel;
use App\AddHotelCheckPoint;
use App\AddHotelImage;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class HotelImagesAndCheckPoints extends Component
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

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:30'],
            'area' => ['required', 'max:50'],
            'subwayStation' => ['required', 'max:50'],
//            'images.*' => ['image', 'size:1024', 'max:1024', 'mimes:png,jpg,jpeg'],
            'hotelImage1' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
            'hotelImage2' => ['required',  'max:1024', 'mimes:png,jpg,jpeg'],
            'hotelImage3' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
            'hotelImageOptional1' => ['nullable', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
            'hotelImageOptional2' => ['nullable', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
            'hotelImageOptional3' => ['nullable', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],

            'checkpointImage1' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
            'checkpointImage2' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
            'checkpointImage3' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],

            'checkpointTitle1' => ['required', 'string', 'max:20'],
            'checkpointTitle2' => ['required', 'string', 'max:20'],
            'checkpointTitle3' => ['required', 'string', 'max:20'],

            'checkpointExplanation1' => ['required', 'string', 'min:20', 'max:180'],
            'checkpointExplanation2' => ['required', 'string', 'min:20', 'max:180'],
            'checkpointExplanation3' => ['required', 'string', 'min:20', 'max:180'],
        ];
    }
    /*, 'dimensions:min_width=800,min_height=600,max_width=2800,max_height=2100'*/

    public function messages(): array
    {
        return [
            'name.required' => '호텔명 은(는) 필수 사항 입니다',
            'name.max' => '호텔명 은(는) :max자 이내 입니다',

            'area.required' => '호텔 주소 은(는) 필수 사항 입니다',
            'area.max' => '호텔 주소 은(는) :max자 이내 입니다',

            'subwayStation.required' => '호텔 근처 지하철역 은(는) 필수 사항 입니다',
            'subwayStation.max' => '호텔 근처 지하철역 은(는) :max자 이내 입니다',

            'hotelImage1.required' => '호텔 외관 이미지 은(는) 필수 사항 입니다',
            'hotelImage1.image' => '호텔 외관 이미지 은(는) 이미지 파일만 가능 합니다',
            'hotelImage1.max' => '호텔 외관 이미지 은(는) :max KB 이하 입니다',
            'hotelImage1.mimes' => '호텔 외관 이미지 은(는) 확장자 png,jpg,jpeg 입니다',

            'hotelImage2.required' => '로비 이미지 은(는) 필수 사항 입니다',
            'hotelImage2.image' => '로비 이미지 은(는) 이미지 파일만 가능 합니다',
            'hotelImage2.max' => '로비 이미지 은(는) :max KB 이하 입니다',
            'hotelImage2.mimes' => '로비 이미지 은(는) 확장자 jpg, jpeg, png 입니다',

            'hotelImage3.required' => '리셉션 이미지 은(는) 필수 사항 입니다',
            'hotelImage3.image' => '리셉션 이미지 은(는) 이미지 파일만 가능 합니다',
            'hotelImage3.max' => '리셉션 이미지 은(는) :max KB 이하 입니다',
            'hotelImage3.mimes' => '리셉션 이미지 은(는) 확장자 png,jpg,jpeg 입니다',

            'hotelImageOptional1.image' => '추가 이미지 은(는) 이미지 파일만 가능 합니다',
            'hotelImageOptional1.max' => '추가 이미지 은(는) :max KB 이하 입니다',
            'hotelImageOptional1.mimes' => '추가 이미지 은(는) 확장자 png,jpg,jpeg 입니다',

            'hotelImageOptional2.image' => '추가 이미지 은(는) 이미지 파일만 가능 합니다',
            'hotelImageOptional2.max' => '추가 이미지 은(는) :max KB 이하 입니다',
            'hotelImageOptional2.mimes' => '추가 이미지 은(는) 확장자 png,jpg,jpeg 입니다',

            'hotelImageOptional3.image' => '리셉션 이미지 은(는) 이미지 파일만 가능 합니다',
            'hotelImageOptional3.max' => '리셉션 이미지 은(는) :max KB 이하 입니다',
            'hotelImageOptional3.mimes' => '리셉션 이미지 은(는) 확장자 png,jpg,jpeg 입니다',

            'checkpointImage1.required' => '이미지 은(는) 필수 사항 입니다',
            'checkpointImage1.image' => '이미지 파일만 가능 합니다',
            'checkpointImage1.max' => '이미지 은(는) :max KB 이하 입니다',
            'checkpointImage1.mimes' => '이미지 은(는) 확장자 png,jpg,jpeg 입니다',

            'checkpointImage2.required' => '이미지 은(는) 필수 사항 입니다',
            'checkpointImage2.image' => '이미지 파일만 가능 합니다',
            'checkpointImage2.max' => '이미지 은(는) :max KB 이하 입니다',
            'checkpointImage2.mimes' => '이미지 은(는) 확장자 png,jpg,jpeg 입니다',

            'checkpointImage3.required' => '이미지 은(는) 필수 사항 입니다',
            'checkpointImage3.image' => '이미지 파일만 가능 합니다',
            'checkpointImage3.max' => '이미지 은(는) :max KB 이하 입니다',
            'checkpointImage3.mimes' => '이미지 은(는) 확장자 png,jpg,jpeg 입니다',

            'checkpointTitle1.required' => '체크포인트 1 은(는) 필수 사항 입니다',
            'checkpointTitle1.string' => '체크포인트 1 은(는) 문자 입력 입니다',
            'checkpointTitle1.max' => '체크포인트 1 은(는) 20자 이내 입니다',

            'checkpointTitle2.required' => '체크포인트 2 은(는) 필수 사항 입니다',
            'checkpointTitle2.string' => '체크포인트 2 은(는) 문자 입력 입니다',
            'checkpointTitle2.max' => '체크포인트 2 은(는) 20자 이내 입니다',

            'checkpointTitle3.required' => '체크포인트 3 은(는) 필수 사항 입니다',
            'checkpointTitle3.string' => '체크포인트 3 은(는) 문자 입력 입니다',
            'checkpointTitle3.max' => '체크포인트 3 은(는) 20자 이내 입니다',

            'checkpointExplanation1.required' => '체크포인트 설명 은(는) 필수 사항 입니다',
            'checkpointExplanation1.string' => '체크포인트 설명 은(는) 문자 입력 입니다',
            'checkpointExplanation1.min' => '체크포인트 설명 은(는) 20자 이상 입니다',
            'checkpointExplanation1.max' => '체크포인트 설명 은(는) 180자 이내 입니다',

            'checkpointExplanation2.required' => '체크포인트 설명 은(는) 필수 사항 입니다',
            'checkpointExplanation2.string' => '체크포인트 설명 은(는) 문자 입력 입니다',
            'checkpointExplanation2.min' => '체크포인트 설명 은(는) 20자 이상 입니다',
            'checkpointExplanation2.max' => '체크포인트 설명 은(는) 180자 이내 입니다',

            'checkpointExplanation3.required' => '체크포인트 설명 은(는) 필수 사항 입니다',
            'checkpointExplanation3.string' => '체크포인트 설명 은(는) 문자 입력 입니다',
            'checkpointExplanation3.min' => '체크포인트 설명 은(는) 20자 이상 입니다',
            'checkpointExplanation3.max' => '체크포인트 설명 은(는) 180자 이내 입니다',

        ];
    }

    public function updated($propertyName)
    {
        $this->submitButton = false;
        $this->validateOnly($propertyName);
        $this->submitButton = true;

        if(Str::of($propertyName)->contains(['img','Image','Img']) &&
            preg_match("/[\xE0-\xFF][\x80-\xFF][\x80-\xFF]/", $this->{$propertyName}->getClientOriginalName())){
            if(Str::of($propertyName)->contains('checkpoint')){
                $path = 'entry/check-point/';
            }else{
                $path = 'entry/hotel-image/';
            }
            $image = $this->{$propertyName}->store($path.$this->user->id, 's3');
            $this->{$propertyName} = $image;
        }
    }

    /* 파일 체크 > 업로드 처리 */
    public function fileBoolCheck($property): bool
    {
        if(is_string($property)){
            return false;
        }
        return true;
    }
    /* 파일 체크 하여 Rules 적용 */
    public function fileCheck($propertyName, $property, $rule='required'): void
    {
        if(is_string($property)){
            $this->rules[$propertyName] = [$rule];
        }else{
            $this->rules[$propertyName] = [$rule, 'image', 'max:1024', 'mimes:png,jpg,jpeg'];
        }
    }
    /* Hotel images update Or Create 처리 */
    private function addHotelImageUpdateOrCreate($order, $image): void
    {
        AddHotelImage::updateOrCreate([
            'add_hotel_id'=>$this->addHotel->id,
            'hotel_manager_id'=>$this->user->id,
            'order'=>$order
        ], [
            'add_hotel_id'=>$this->addHotel->id,
            'hotel_manager_id'=>$this->user->id,
            'image' => $image,
            'order'=>$order
        ]);
    }
    /* Hotel CheckPoint update Or Create 처리 */
    private function addHotelCheckPointUpdateOrCreate($order, $image, $title, $explanation): void
    {
        AddHotelCheckPoint::updateOrCreate([
            'add_hotel_id'=>$this->addHotel->id,
            'hotel_manager_id'=>$this->user->id,
            'order'=>$order
        ], [
            'add_hotel_id'=>$this->addHotel->id,
            'hotel_manager_id'=>$this->user->id,
            'order'=> $order,
            'image'=>$image,
            'title'=>$title,
            'explanation'=>$explanation
        ]);
    }

    /* Hotel Image Delete 처리 */
    private function addHotelImageDelete($order){
        $image = AddHotelImage::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->whereOrder($order)->first();
        if($image){
            //Storage::disk('s3')->delete($image->image);// 실 s3 삭제 처리
            $image->delete();
        }
    }

    public function HotelImagesAndCheckPointsSave()
    {
        $loadingDate = now();
        $this->rules = [
            'name' => ['required', 'max:30'],
            'area' => ['required', 'max:50'],
            'subwayStation' => ['required', 'max:50'],

            'checkpointTitle1' => ['required', 'string', 'max:20'],
            'checkpointTitle2' => ['required', 'string', 'max:20'],
            'checkpointTitle3' => ['required', 'string', 'max:20'],

            'checkpointExplanation1' => ['required', 'string', 'min:20', 'max:180'],
            'checkpointExplanation2' => ['required', 'string', 'min:20', 'max:180'],
            'checkpointExplanation3' => ['required', 'string', 'min:20', 'max:180'],
        ];
        $this->fileCheck('hotelImage1', $this->hotelImage1);
        $this->fileCheck('hotelImage2', $this->hotelImage2);
        $this->fileCheck('hotelImage3', $this->hotelImage3);
        $this->fileCheck('hotelImageOptional1', $this->hotelImageOptional1, 'nullable');
        $this->fileCheck('hotelImageOptional2', $this->hotelImageOptional2, 'nullable');
        $this->fileCheck('hotelImageOptional3', $this->hotelImageOptional3, 'nullable');
        $this->fileCheck('checkpointImage1', $this->checkpointImage1);
        $this->fileCheck('checkpointImage2', $this->checkpointImage2);
        $this->fileCheck('checkpointImage3', $this->checkpointImage3);

        $validatedData = $this->validate($this->rules);

        $this->addHotel->name=$this->name;
        $this->addHotel->area=$this->area;
        $this->addHotel->subway_station=$this->subwayStation;

        $this->addHotel->save();

        if($this->fileBoolCheck($this->hotelImage1)){
            $hotelImage1 = $this->hotelImage1->store('entry/hotel-image/'.$this->user->id, 's3');
        }else{
            $hotelImage1 = $this->hotelImage1;
        }
        $this->addHotelImageUpdateOrCreate(1, $hotelImage1);

        if($this->fileBoolCheck($this->hotelImage2)){
            $hotelImage2 = $this->hotelImage2->store('entry/hotel-image/'.$this->user->id, 's3');
        }else{
            $hotelImage2 = $this->hotelImage2;
        }
        $this->addHotelImageUpdateOrCreate(2, $hotelImage2);

        if($this->fileBoolCheck($this->hotelImage3)){
            $hotelImage3 = $this->hotelImage3->store('entry/hotel-image/'.$this->user->id, 's3');
        }else{
            $hotelImage3 = $this->hotelImage3;
        }
        $this->addHotelImageUpdateOrCreate(3, $hotelImage3);
        /*if($this->fileBoolCheck($this->hotelImage1)){
            $this->addHotelImage1->image=$hotelImage1;
            $this->addHotelImage1->save();
        }*/

        if(isset($this->hotelImageOptional1) && $this->hotelImageOptional1 !=='' && $this->hotelImageOptional1 !==null){
            if($this->fileBoolCheck($this->hotelImageOptional1)){
                $hotelImageOptional1 = $this->hotelImageOptional1->store('entry/hotel-image/'.$this->user->id, 's3');
            }else{
                $hotelImageOptional1 = $this->hotelImageOptional1;
            }
            $this->addHotelImageUpdateOrCreate(4, $hotelImageOptional1);
        }else{
            $this->addHotelImageDelete(4);
        }

        if(isset($this->hotelImageOptional2) && $this->hotelImageOptional2 !=='' && $this->hotelImageOptional2 !==null){
            if($this->fileBoolCheck($this->hotelImageOptional2)){
                $hotelImageOptional2 = $this->hotelImageOptional2->store('entry/hotel-image/'.$this->user->id, 's3');
            }else{
                $hotelImageOptional2 = $this->hotelImageOptional2;
            }
            $this->addHotelImageUpdateOrCreate(5, $hotelImageOptional2);
        }else{
            $this->addHotelImageDelete(5);
        }

        if(isset($this->hotelImageOptional3) && $this->hotelImageOptional3 !=='' && $this->hotelImageOptional3 !==null){
            if($this->fileBoolCheck($this->hotelImageOptional3)){
                $hotelImageOptional3 = $this->hotelImageOptional3->store('entry/hotel-image/'.$this->user->id, 's3');
            }else{
                $hotelImageOptional3 = $this->hotelImageOptional3;
            }
            $this->addHotelImageUpdateOrCreate(6, $hotelImageOptional3);
        }else{
            $this->addHotelImageDelete(6);
        }

        if($this->fileBoolCheck($this->checkpointImage1)){
            $checkpointImage1 = $this->checkpointImage1->store('entry/check-point/'.$this->user->id, 's3');
        }else{
            $checkpointImage1 = $this->checkpointImage1;
        }
        $this->addHotelCheckPointUpdateOrCreate(1, $checkpointImage1, $this->checkpointTitle1, $this->checkpointExplanation1);


        if($this->fileBoolCheck($this->checkpointImage2)){
            $checkpointImage2 = $this->checkpointImage2->store('entry/check-point/'.$this->user->id, 's3');
        }else{
            $checkpointImage2 = $this->checkpointImage2;
        }
        $this->addHotelCheckPointUpdateOrCreate(2, $checkpointImage2, $this->checkpointTitle2, $this->checkpointExplanation2);


        if($this->fileBoolCheck($this->checkpointImage3)){
            $checkpointImage3 = $this->checkpointImage3->store('entry/check-point/'.$this->user->id, 's3');
        }else{
            $checkpointImage3 = $this->checkpointImage3;
        }
        $this->addHotelCheckPointUpdateOrCreate(3, $checkpointImage3, $this->checkpointTitle3, $this->checkpointExplanation3);

        if($loadingDate->diffInRealMicroseconds(now()) <= 500000){
            usleep(500000-$loadingDate->diffInRealMicroseconds(now()));
        }
        //$this->emitTo('hotels.entry.core', 'HotelEntryTabChangeEvent', 'add');
        return redirect()->route('hotel-entry.hotel', [ 'tab' => 2, 'hotel'=>$this->addHotel->id]);
    }

    /* 이미지 삭제 처리*/
    public function hotelImagesRemoverEvent($target): void
    {
        $this->reset($target);
        $this->resetErrorBag($target);
    }

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.hotels.entry.hotel-images-and-check-points');
	}
}
