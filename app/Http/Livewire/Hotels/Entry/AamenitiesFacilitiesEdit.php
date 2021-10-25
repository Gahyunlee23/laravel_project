<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotelAmenity;
use App\AddHotelFacility;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class AamenitiesFacilitiesEdit extends Component
{
    use WithFileUploads;
    /* Request */
    public $addHotel;
    public $edit;

    protected $listeners = [
        'ItemsEditEvent'=>'submit'
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
            $this->user = auth()->user();
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
        $this->amenities[] = $this->amenity;
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
        $this->without_amenities[] = $this->without_amenity;
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
        $this->facilitiesSave();
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
	public function render()
	{
		return view('livewire.hotels.entry.aamenities-facilities-edit');
	}
}
