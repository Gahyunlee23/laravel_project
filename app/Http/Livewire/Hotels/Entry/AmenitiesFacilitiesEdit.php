<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotelAmenity;
use App\AddHotelFacility;
use App\AddHotelNeedToModify;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class AmenitiesFacilitiesEdit extends Component
{
    use WithFileUploads;
    /* Request */
    public $addHotel;
    public $edit;
    public $user;

    protected $listeners = [
        'amenitiesFacilitiesEditEvent'=>'submit'
    ];

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
            'facility.*.name'=>[
                'required',
                'min:2',
                'max:30'
            ],
            'facility.*.explanation'=>[
                'required',
                'min:2',
                'max:150'
            ]
        ];
    }

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

    public function amenityAdd(): void
    {
        $this->validateOnly('amenity');
        if($this->amenity !== null && $this->amenity !== ''){
            $this->amenities[] = $this->amenity;
        }
        $this->reset('amenity');
        $this->amenityCheck();
    }
    public function amenityRemove($index): void
    {
        $this->amenities = collect($this->amenities)->forget($index);
        $this->amenityCheck();
    }
    public function amenityCheck(){
        AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)->whereModel('AddHotelAmenity')->whereTarget('amenity')->whereNull('status')->update([
            'status'=>'확인'
        ]);
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
        $this->withoutAmenityCheck();
    }
    public function withoutAmenityRemove($index): void
    {
        $this->without_amenities = collect($this->without_amenities)->forget($index);
        $this->withoutAmenityCheck();
    }

    public function withoutAmenityCheck(){
        AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)->whereModel('AddHotelAmenity')->whereTarget('without_amenity')->whereNull('status')->update([
            'status'=>'확인'
        ]);
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
            AddHotelAmenity::create([
                'add_hotel_id'=>$this->addHotel->id,
                'hotel_manager_id'=>$this->user->id,
                'without'=>'1',
                'name'=>$item
            ]);
        }
    }

    public function facilityCountAdd(){
        $this->facility[] = ['name'=>'', 'explanation'=>''];
        AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facilityCountAdd')->whereNull('status')->update([
            'status'=>'확인'
        ]);
    }
    public function facilityRemove($index)
    {
        $this->facilities = collect($this->facility)->forget($index);
        $this->facility = [];
        foreach ($this->facilities as $item){
            $this->facility[] = ['name'=>$item['name'] ?? '', 'explanation'=>$item['explanation'] ?? ''];
        }
        AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facilityRemove.'.$index)->whereNull('status')->update([
            'status'=>'확인'
        ]);
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
        $this->amenitiesSave();
        $this->withoutAmenitiesSave();
        $this->saveFacility();

        $this->emitUp('coreOtherEditEvent');
    }

    public function backRedirect($tab)
    {
        return redirect()->route('hotel-entry.hotel',['hotel'=>$this->addHotel->id, 'tab' => $tab]);
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
        //'AddHotelFacility';
       // 'AddHotelAmenity';
        if(Str::of($propertyName)->contains('facility.')){
            AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)->whereModel('AddHotelFacility')->whereTarget($propertyName)->whereNull('status')->update([
                'status'=>'확인'
            ]);
        }
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.hotels.entry.amenities-facilities-edit');
	}
}
