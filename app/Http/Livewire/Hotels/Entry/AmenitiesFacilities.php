<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotelAmenity;
use App\AddHotelFacility;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AmenitiesFacilities extends Component
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

    public $facility_infos;
    public $facility_name;
    // facility categories
    public $facility_categories = ['편의', '식음', '피트니스', '비즈니스', '기타'];

    public $detailed_categories = [
        ['라운지', '공유 주방', '주차장',  '세탁실', '편의점'],
        ['레스토랑', '바', '카페', '다이닝&바', '식당', '베이커리', '펍'],
        ['피트니스 센터', '사우나', '실내 수영장', '야외 수영장', '실내 골프연습장', '스파'],
        ['비즈니스 센터', '미팅룸', '연회장'],
        ['루프탑']
    ];

    public $added_facility;
    public $added_facilities;
    public $added_infos;

    public $amenity_caption = ['객실', '욕실'];
    public $amenity_category = [
        ['인터넷', '엔터네인먼트', '가전', '주방용품', '식음료', '가구', '사무용품', '의류용품', '기타'],
        ['욕실용품', '어메니티']
    ];
    public $amenity_lists = [
        [
            ['WiFi', '유선 인터넷'],
            ['TV', '전화기', '블루투스 스피커', '라디오', '국제전화'],
            ['냉·난방기', '냉장고', '전자렌지', '스타일러', '세탁기', '멀티충전 케이블', '휴대폰 충전기', '커피포트', '캡슐 커피머신'],
            ['간이주방', '인덕션', '찻잔', '컵', '와인잔', '와인 오프너', '티스푼'],
            ['생수', '미니바', '커피 세트', '티 세트'],
            ['개인금고', '수납장', '옷장', '소파', '의자', '암막커튼'],
            ['사무용 책상', '스탠드', '필기류', '메모패드'],
            ['슬리퍼', '가운', '잠옷', '다리미', '다리미판', '구두 클리너', '구두주걱', '건조대', '옷걸이', '옷솔'],
            ['알람시계', '체중계', '손전등', '신문', '우산', '잡지', '쇼핑백', '220/240V AC']
        ],
        [
          ['샤워부스', '욕조', '비데', '헤어드라이어', '수건', '휴지', '빗', '양치컵'],
          ['샴푸', '컨디셔너', '바디워시', '바디로션', '클렌징폼', '칫솔', '스킨&로션', '샤워캡', '샤워 스폰지', '면봉', '면도기']
        ]
    ];

    public $amenity_records;

    public $names;
    public $checkCategory;

    public $amenitiesData;


    public function throwAmenityError() {
        if($this->amenity_records === null || $this->amenity_records === '') {

        }
    }

    public function initializeAmenity(){
        $this->amenitiesData = AddHotelAmenity::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->get();
    }

    public function getActiveAmenities($tab, $depth, $index, $list) {
        if(isset($this->amenity_records[$tab][$depth][$index]) && $this->amenity_lists[$tab][$depth][$index] === $list) {
            $this->amenity_records[$tab][$depth] = collect($this->amenity_records[$tab][$depth])->forget($index)->all();
            AddHotelAmenity::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->where('name', '=', $list)->delete();
        } else {
            $this->amenity_records[$tab][$depth][$index] = $list;
        }
    }

    public function saveAmenity() {
        if($this->amenity_records) {
            foreach($this->amenity_records as $tabIndex=>$records) {
                foreach($records as $depthIndex=>$record) {
                    foreach($record as $item) {
                        AddHotelAmenity::UpdateOrCreate(
                            [
                                'add_hotel_id' => $this->addHotel->id,
                                'hotel_manager_id' => $this->user->id,
                                'caption' => $tabIndex,
                                'category' => $depthIndex,
                                'name' => $item
                            ],
                            [
                                'add_hotel_id' => $this->addHotel->id,
                                'hotel_manager_id' => $this->user->id,
                                'caption' => $tabIndex,
                                'category' => $depthIndex,
                                'name' => $item
                            ]
                        );
                    }
                }
            }
        }
    }

    public function initializeFacilities() {
        $this->facilities = AddHotelFacility::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->get();

        foreach($this->facilities as $index => $data) {
            if(!empty($data->category)) {
                $category_index = array_search($data->category, $this->facility_categories);
                $detailed_category_index = array_search($data->name, $this->detailed_categories[$category_index]);
                $this->facility_name[$category_index][$detailed_category_index] = $data->name;
                $this->facility_infos[$category_index][$detailed_category_index] =  [
                    'location' => $data['location'],
                    'time' => $data['time'],
                    'cost' => $data['cost'],
                    'caution' => $data['caution']
                ];

            } else {
                $this->added_facilities[$index] = $data->name;
                if($data->location === null) {
                    $this->added_infos[$index] = [
                        'caution' => $data['explanation']
                    ];
                } else {
                    $this->added_infos[$index] = [
                        'location' => $data['location'],
                        'time' => $data['time'],
                        'cost' => $data['cost'],
                        'caution' => $data['caution']
                    ];
                }
            }
        }
    }

    public function saveAddedFacility() {
        if(!empty($this->added_facilities) && !empty($this->added_infos)) {
            foreach($this->added_facilities as $index => $added_facility) {
                foreach($this->added_infos as $added_info) {
                    AddHotelFacility::updateOrCreate([
                        'add_hotel_id'=>$this->addHotel->id,
                        'hotel_manager_id'=>$this->user->id,
                        'name' => $this->added_facilities[$index],
                        'location' => $added_info['location'] ?? '',
                        'time' => $added_info['time'] ?? '',
                        'cost' => $added_info['cost'] ?? '',
                        'caution' => $added_info['caution'] ?? '',
                        'explanation' => '해당 사항 없음'
                    ],[
                        'add_hotel_id'=>$this->addHotel->id,
                        'hotel_manager_id'=>$this->user->id,
                        'name' => $this->added_facilities[$index],
                        'location' => $added_info['location'] ?? '',
                        'time' => $added_info['time'] ?? '',
                        'cost' => $added_info['cost'] ?? '',
                        'caution' => $added_info['caution'] ?? '',
                        'explanation' => '해당 사항 없음'
                    ]);
                }
            }
        }
    }

    public function addFacilities() {
        if($this->added_facility !== null && $this->added_facility !== ''){
            $this->added_facilities[] = $this->added_facility;
        }
        $this->reset('added_facility');
    }

    public function deleteFacility($index) {
        $this->added_facilities = collect($this->added_facilities)->forget($index);
    }

    public function saveFacility() {
        if(!empty($this->facility_infos)) {
            foreach($this->facility_infos as $tabIndex => $infos) {
                foreach($infos as $depthIndex => $info) {
                    AddHotelFacility::UpdateOrCreate(
                        [
                            'add_hotel_id'=>$this->addHotel->id,
                            'hotel_manager_id'=>$this->user->id,
                            'category' => $this->facility_categories[$tabIndex],
                            'name' => $this->detailed_categories[$tabIndex][$depthIndex],
                            'location' => $info['location'] ?? '',
                            'time' => $info['time'] ?? '',
                            'cost' => $info['cost'] ?? '',
                            'caution' => $info['caution'] ?? '',
                            'explanation' => '해당 사항 없음'
                        ],
                        [
                        'add_hotel_id'=>$this->addHotel->id,
                        'hotel_manager_id'=>$this->user->id,
                        'category' => $this->facility_categories[$tabIndex],
                        'name' => $this->detailed_categories[$tabIndex][$depthIndex],
                        'location' => $info['location'] ?? '',
                        'time' => $info['time'] ?? '',
                        'cost' => $info['cost'] ?? '',
                        'caution' => $info['caution'] ?? '',
                        'explanation' => '해당 사항 없음'
                    ]);
                }
            }
        }

    }

    public function rules(): array
    {
        return [

            'amenity'=>[
                'nullable',
                'min:2',
                'max:30',
                function ($attribute, $value, $fail) {
                    if (collect($this->amenities)->contains($value)) {
                        $fail(' 중복 된 입력값 입니다.');
                    }
                },
            ],
            'without_amenity'=>[
                'nullable',
                'min:2',
                'max:30',
                function ($attribute, $value, $fail) {
                    if (collect($this->without_amenities)->contains($value)) {
                        $fail(' 중복 된 입력값 입니다.');
                    }
                },
            ],
            'facility_infos.*.' => [
                'required'
            ]

         ];
    }

    public function mount(){
        if(auth()->check()){
            $this->user = auth()->user();
        }
        $this->initializeAmenity();
    }

    public function amenityInit()
    {
        $this->amenities = AddHotelAmenity::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->where('caption', '=', 'null')
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

    public function amenityAdd(): void
    {
        $this->validateOnly('amenity');
        if($this->amenity!==null && $this->amenity !==''){
            $this->amenities[] = $this->amenity;
        }
        $this->reset('amenity');
    }
    public function amenityRemove($index): void
    {
        $this->amenities = collect($this->amenities)->forget($index);
    }
    public function amenitiesSave(): void
    {
        try {
            $this->validateOnly('amenity');
        } catch (ValidationException $e) {
            Log::channel('slack-debug')->debug($e);
        }
        AddHotelAmenity::onlyTrashed()->whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->whereNull('without')->forceDelete();
        AddHotelAmenity::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->whereNull('without')->delete();
        foreach ($this->amenities as $index => $amenity) {
            AddHotelAmenity::create([
                'add_hotel_id'=>$this->addHotel->id,
                'hotel_manager_id'=>$this->user->id,
                'without'=>null,
                'name'=>$amenity
            ]);
        }
    }

    public function withoutAmenityAdd(): void
    {
        $this->validateOnly('without_amenity');
        if($this->without_amenity !== null && $this->without_amenity !== ''){
            $this->without_amenities[] = $this->without_amenity;
        }
        $this->reset('without_amenity');
    }
    public function withoutAmenityRemove($index): void
    {
        $this->without_amenities = collect($this->without_amenities)->forget($index);
    }
    public function withoutAmenitiesSave(): void
    {
        try {
            $this->validateOnly('without_amenity');
        } catch (ValidationException $e) {
            Log::channel('slack-debug')->debug($e);
        }
        AddHotelAmenity::onlyTrashed()->whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->whereWithout('1')->forceDelete();
        AddHotelAmenity::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->whereWithout('1')->delete();
        foreach ($this->without_amenities as $index => $item) {
            AddHotelAmenity::updateOrCreate([
                'add_hotel_id'=>$this->addHotel->id,
                'hotel_manager_id'=>$this->user->id,
                'without'=>'1',
                'name'=>$item
            ]);
        }
    }

    public function facilityCountAdd(){
        $this->facility[] = ['name'=>'', 'explanation'=>''];
    }
    public function facilityRemove($index)
    {
        $this->facilities = collect($this->facility)->forget($index);
        $this->facility = [];
        foreach ($this->facilities as $item){
            $this->facility[] = ['name'=>$item['name'] ?? '', 'explanation'=>$item['explanation'] ?? ''];
        }
    }
    public function facilitiesSave()
    {
        $this->validateOnly('facility.*.name');
        $this->validateOnly('facility.*.explanation');
        AddHotelFacility::onlyTrashed()->whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->forceDelete();
        AddHotelFacility::whereAddHotelId($this->addHotel->id)->whereHotelManagerId($this->user->id)->delete();
        foreach ($this->facility as $item) {
            AddHotelFacility::create([
                'add_hotel_id'=>$this->addHotel->id,
                'hotel_manager_id'=>$this->user->id,
                'name'=>$item['name'] ?? null,
                'explanation'=>$item['explanation'] ?? null
            ]);
        }

    }

    public function submit(){
        $loadingDate = now();
        $this->amenitiesSave();
        $this->withoutAmenitiesSave();
        if(auth()->check() && auth()->user()->hasAnyRole('개발')) {
            $this->saveAmenity();
        }
        $this->saveFacility();
        $this->saveAddedFacility();


        if($loadingDate->diffInRealMicroseconds(now()) <= 500000){
            usleep(500000-$loadingDate->diffInRealMicroseconds(now()));
        }
        return redirect()->route('hotel-entry.hotel', ['tab' => 6, 'hotel'=>$this->addHotel->id]);
    }

    public function backRedirect($tab)
    {
        return redirect()->route('hotel-entry.hotel',['hotel'=>$this->addHotel->id, 'tab' => $tab]);
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render() {
		return view('livewire.hotels.entry.amenities-facilities');
	}
}
