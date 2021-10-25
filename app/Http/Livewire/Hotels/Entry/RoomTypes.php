<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotelRoomType;
use App\AddHotelRoomTypeImage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Request;
use Livewire\WithFileUploads;

class RoomTypes extends Component
{
    use WithFileUploads;
    /* Request */
    public $addHotel;

    /* Data */
    public $user;
    public $rules;
    public $messages;
    /*public $rules = [
        'room_type_image_1.*' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
        'room_type_image_2.*' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
        'room_type_image_3.*' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
        'room_type_name.*' => ['required', 'max:50'],
        'room_type_main_explanation.*' => ['required', 'max:50'],
        'room_type_sub_explanation.*' => ['required', 'max:50'],
    ];
    public $messages = [
        'room_type_image_1.*.required' => '룸 이미지 1 은(는) 필수 사항 입니다',
        'room_type_image_1.*.image' => '룸 이미지 1 은(는) 이미지 파일만 가능 합니다',
        'room_type_image_1.*.max' => '룸 이미지 1 은(는) :max KB 이하 입니다',
        'room_type_image_1.*.mimes' => '룸 이미지 1 은(는) 확장자 png,jpg,jpeg 입니다',
        'room_type_image_2.*.required' => '룸 이미지 2 은(는) 필수 사항 입니다',
        'room_type_image_2.*.image' => '룸 이미지 2 은(는) 이미지 파일만 가능 합니다',
        'room_type_image_2.*.max' => '룸 이미지 2 은(는) :max KB 이하 입니다',
        'room_type_image_2.*.mimes' => '룸 이미지 2 은(는) 확장자 png,jpg,jpeg 입니다',
        'room_type_image_3.*.required' => '룸 이미지 3 은(는) 필수 사항 입니다',
        'room_type_image_3.*.image' => '룸 이미지 3 은(는) 이미지 파일만 가능 합니다',
        'room_type_image_3.*.max' => '룸 이미지 3 은(는) :max KB 이하 입니다',
        'room_type_image_3.*.mimes' => '룸 이미지 3 은(는) 확장자 png,jpg,jpeg 입니다',
        'room_type_name.*.required' => '룸 이름 은(는) 필수 사항 입니다',
        'room_type_name.*.max' => '룸 이름 은(는) :max자 이내 입니다',
        'room_type_main_explanation.*.required' => '침대 종류, 개수 은(는) 필수 사항 입니다',
        'room_type_main_explanation.*.max' => '침대 종류, 개수 은(는) :max자 이내 입니다',
        'room_type_sub_explanation.*.required' => '룸 면적 은(는) 필수 사항 입니다',
        'room_type_sub_explanation.*.max' => '룸 면적 은(는) :max자 이내 입니다',
    ];*/

    public $room_type;
    public $room_type_image_1 = [];
    public $room_type_image_2 = [];
    public $room_type_image_3 = [];
    public $room_type_name = [];
    public $room_type_main_explanation = [];
    public $room_type_sub_explanation = [];

    public $image_tmp;

    /* Alpine*/
    public $submitButton = false;
    public $count;


    protected $listeners = [
        'RoomImagesRemoverEvent'
    ];

    public function mount(): void
    {
        $limit = 2;
        /* 최소 3개 세팅 - 홀수 : 룸 추가 버튼 까지 짝수*/
        if(auth()->check()){
            $this->user = auth()->user();
//            $count = AddHotelRoomType::where('add_hotel_id', '=', $this->addHotel->id)
//                ->where('hotel_manager_id', '=', auth()->user()->id)
//                ->count();
//            $this->count = $count === 0 ? $limit : $count + 1;
            $this->ruleCopy();
            $this->messageCopy();
            $this->dataLoad();
        }
    }
    /* 유동적 룰 */
    public function ruleCopy(): void
    {
        $this->rules['room_type_image_1.*'] = ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'];
        $this->rules['room_type_image_2.*'] = ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'];
        $this->rules['room_type_image_3.*'] = ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'];
        $this->rules['room_type_name.*'] = ['required', 'max:50'];
        $this->rules['room_type_main_explanation.*'] = ['required', 'max:50'];
        $this->rules['room_type_sub_explanation.*'] = ['required', 'max:10'];
    }
    public function messageCopy(): void
    {
        $this->messages['room_type_image_1.*.required'] = '룸 이미지 1 은(는) 필수 사항 입니다';
        $this->messages['room_type_image_1.*.image'] = '룸 이미지 1 은(는) 이미지 파일만 가능 합니다';
        $this->messages['room_type_image_1.*.max'] = '룸 이미지 1 은(는) :max KB 이하 입니다';
        $this->messages['room_type_image_1.*.mimes'] = '룸 이미지 1 은(는) 확장자 png,jpg,jpeg 입니다';

        $this->messages['room_type_image_2.*.required'] = '룸 이미지 2 은(는) 필수 사항 입니다';
        $this->messages['room_type_image_2.*.image'] = '룸 이미지 2 은(는) 이미지 파일만 가능 합니다';
        $this->messages['room_type_image_2.*.max'] = '룸 이미지 2 은(는) :max KB 이하 입니다';
        $this->messages['room_type_image_2.*.mimes'] = '룸 이미지 2 은(는) 확장자 png,jpg,jpeg 입니다';

        $this->messages['room_type_image_3.*.required'] = '룸 이미지 3 은(는) 필수 사항 입니다';
        $this->messages['room_type_image_3.*.image'] = '룸 이미지 3 은(는) 이미지 파일만 가능 합니다';
        $this->messages['room_type_image_3.*.max'] = '룸 이미지 3 은(는) :max KB 이하 입니다';
        $this->messages['room_type_image_3.*.mimes'] = '룸 이미지 3 은(는) 확장자 png,jpg,jpeg 입니다';

        $this->messages['room_type_name.*.required'] = '룸 이름 은(는) 필수 사항 입니다';
        $this->messages['room_type_name.*.max'] = '룸 이름 은(는) :max자 이내 입니다';

        $this->messages['room_type_main_explanation.*.required'] = '침대 종류, 개수 은(는) 필수 사항 입니다';
        $this->messages['room_type_main_explanation.*.max'] = '침대 종류, 개수 은(는) :max자 이내 입니다';

        $this->messages['room_type_sub_explanation.*.required'] = '룸 면적 은(는) 필수 사항 입니다';
        $this->messages['room_type_sub_explanation.*.max'] = '룸 면적 은(는) :max자 이내 입니다';
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
            if($addHotelRoomTypes->count()>=1){
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
            }else{
                $this->room_type[] = 1;
                $this->room_type_name[1] = '';
                $this->room_type_main_explanation[1] = '';
                $this->room_type_sub_explanation[1] = '';
                $this->room_type_image_1[1] = '';
                $this->room_type_image_2[1] = '';
                $this->room_type_image_3[1] = '';
            }
        }
    }

    public function roomTypesSave()
    {
        $loadingDate = now();
        $this->reset('rules');

        foreach (collect($this->room_type)->filter(function($item,$index){ if($index!==0){ return $item !==null; } }) as $i=>$item){
            $this->rules['room_type_name.'.$item] = ['required', 'max:50'];
            $this->rules['room_type_main_explanation.'.$item] = ['required', 'max:50'];
            $this->rules['room_type_sub_explanation.'.$item] = ['required', 'max:10'];
            $this->fileCheck('room_type_image_1.'.$item, $this->room_type_image_1[$i] ?? null);
            $this->fileCheck('room_type_image_2.'.$item, $this->room_type_image_2[$i] ?? null);
            $this->fileCheck('room_type_image_3.'.$item, $this->room_type_image_3[$i] ?? null);
        }
       /* for ($i=1; $i<=collect($this->room_type)->filter(function($item,$index){ if($index!==0){ return $item !==null; } })->count(); $i++){

        }*/
        $validate = $this->validate($this->rules, $this->messages);
        $this->addHotelRoomTypeUpdateOrCreate();

        foreach ($this->room_type_image_1 as $index=>$item){
            if( $item !==null ){
                if($this->fileBoolCheck($item)) {
                    $room_type_image_1[] = $item->store('entry/room-type/'.$this->user->id, 's3');
                }else {
                    $room_type_image_1[] = $item;
                }
            }
        }
        foreach ($this->room_type_image_2 as $index=>$item){
            if( $item !==null ){
                if($this->fileBoolCheck($item)) {
                    $room_type_image_2[] = $item->store('entry/room-type/'.$this->user->id, 's3');
                }else {
                    $room_type_image_2[] = $item;
                }
            }
        }
        foreach ($this->room_type_image_3 as $index=>$item){
            if( $item !==null ){
                if($this->fileBoolCheck($item)) {
                    $room_type_image_3[] = $item->store('entry/room-type/'.$this->user->id, 's3');
                }else {
                    $room_type_image_3[] = $item;
                }
            }
        }
        /* 룸 타입 이미지 업로드 */
        $this->addHotelRoomTypeImageUpdateOrCreate($room_type_image_1, $room_type_image_2, $room_type_image_3);
        if($loadingDate->diffInRealMicroseconds(now()) < 500000){
            usleep(500000-$loadingDate->diffInRealMicroseconds(now()));
        }
        return redirect()->route('hotel-entry.hotel', ['tab' => 3, 'hotel'=>$this->addHotel->id]);
    }
    /* Hotel room type update Or Create 처리 */
    private function addHotelRoomTypeUpdateOrCreate(): void
    {
        AddHotelRoomType::onlyTrashed()->whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->forceDelete();
        AddHotelRoomType::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->delete();
        $i=1;
        foreach (collect($this->room_type)->filter(function($item,$index){ if($index!==0){ return $item !==null; } }) as $index => $item){
            if($index!==0){
                AddHotelRoomType::create([
                    'add_hotel_id'=>$this->addHotel->id,
                    'hotel_manager_id'=>$this->user->id,
                    'order'=>$i,
                    'name' => $this->room_type_name[$index],
                    'main_explanation' => $this->room_type_main_explanation[$index],
                    'sub_explanation' => $this->room_type_sub_explanation[$index]
                ]);
                $i++;
            }
        }
    }
    /* Hotel room type update Or Create 처리 */
    private function addHotelRoomTypeImageUpdateOrCreate($image1, $image2, $image3): void
    {
        AddHotelRoomTypeImage::onlyTrashed()->whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->forceDelete();
        AddHotelRoomTypeImage::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->delete();
        foreach ($image1 as $index=>$item){
            if($index!==0){
                $roomType = AddHotelRoomType::whereAddHotelId($this->addHotel->id)
                    ->whereHotelManagerId($this->user->id)->whereOrder($index)->latest()->first();
                AddHotelRoomTypeImage::create([
                    'add_hotel_id'=>$this->addHotel->id,
                    'hotel_manager_id'=>$this->user->id,
                    'add_hotel_room_type_id'=>$roomType->id ?? null,
                    'order'=>1,
                    'image' => $image1[$index]
                ]);
                AddHotelRoomTypeImage::create([
                    'add_hotel_id'=>$this->addHotel->id,
                    'hotel_manager_id'=>$this->user->id,
                    'add_hotel_room_type_id'=>$roomType->id ?? null,
                    'order'=>2,
                    'image' => $image2[$index]
                ]);
                AddHotelRoomTypeImage::create([
                    'add_hotel_id'=>$this->addHotel->id,
                    'hotel_manager_id'=>$this->user->id,
                    'add_hotel_room_type_id'=>$roomType->id ?? null,
                    'order'=>3,
                    'image' => $image3[$index]
                ]);
            }
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
        if($property === null || !is_string($property)){
            $this->rules[$propertyName] = [$rule, 'image', 'max:1024', 'mimes:png,jpg,jpeg'];
        }else{
            $this->rules[$propertyName] = [$rule];
        }
    }
    /* 이미지 삭제 처리*/
    public function RoomImagesRemoverEvent($target, $index): void
    {
        //$this->{$target}[$index] = null;
        //$this->reset($target[$index]);
        $this->{$target}[$index] = null;
        $this->resetErrorBag($target[$index]);
    }

    public function countAdd(): void
    {
        $i=collect($this->room_type)->count();
        if($this->room_type_image_1[$i-1] === '' || $this->room_type_image_2[$i-1] === '' || $this->room_type_image_3[$i-1] === ''
            ||$this->room_type_name[$i-1] === '' || $this->room_type_main_explanation[$i-1] === '' || $this->room_type_sub_explanation[$i-1] === ''){
            session()->flash('countAddMessage', '이전 룸 타입 정보를 모두 입력 후 추가해주세요');
        }else{
            $this->room_type[] = $i;
            $this->room_type_image_1[] = '';
            $this->room_type_image_2[] = '';
            $this->room_type_image_3[] = '';
            $this->room_type_name[] = '';
            $this->room_type_main_explanation[] = '';
            $this->room_type_sub_explanation[] = '';
        }
    }
    /*실제 룸 삭제 처리*/
    public function roomTypeRemove($index){
        $this->resetErrorBag();
        $this->room_type[$index]=null;                  //            = collect($this->room_type)->forget($index);
        $this->room_type_image_1[$index]=null;                  //            = collect($this->room_type_image_1)->forget($index);
        $this->room_type_image_2[$index]=null;                  //            = collect($this->room_type_image_2)->forget($index);
        $this->room_type_image_3[$index]=null;                  //            = collect($this->room_type_image_3)->forget($index);
        $this->room_type_name[$index]=null;                 //               = collect($this->room_type_name)->forget($index);
        $this->room_type_main_explanation[$index]=null;                 //   = collect($this->room_type_main_explanation)->forget($index);
        $this->room_type_sub_explanation[$index]=null;                  //    = collect($this->room_type_sub_explanation)->forget($index);
    }

    public function backRedirect($tab)
    {
        return redirect()->route('hotel-entry.hotel', [ 'tab' => $tab, 'hotel'=>$this->addHotel->id]);
    }

    public function updated($propertyName): void
    {
        $this->submitButton = false;
        try {
            $this->validateOnly($propertyName);
        } catch (ValidationException $e) {
            Log::channel('slack-debug')->debug($e);
        }
        $this->submitButton = true;

        if(Str::of($propertyName)->contains('.')) {
            $data = Str::of($propertyName)->explode('.');
            if(Str::of($propertyName)->contains(['img', 'Img', 'image', 'Image']) &&
                preg_match("/[\xE0-\xFF][\x80-\xFF][\x80-\xFF]/", $this->{$data[0]}[$data[1]]->getClientOriginalName())){
                $image = $this->{$data[0]}[$data[1]]->store('entry/room-type/'.$this->user->id, 's3');
                $this->{$data[0]}[$data[1]] = $image;
            }
        }else{
            if(Str::of($propertyName)->contains(['img', 'Img', 'image', 'Image']) &&
                preg_match("/[\xE0-\xFF][\x80-\xFF][\x80-\xFF]/", $this->{$propertyName}->getClientOriginalName())){
                $image = $this->{$propertyName}->store('entry/room-type/'.$this->user->id, 's3');
                $this->{$propertyName} = $image;
            }
        }
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.hotels.entry.room-types');
    }
}
