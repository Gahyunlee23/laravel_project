<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotelBenefit;
use App\AddHotelNeedToModify;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class BenefitsEdit extends Component
{
    /* Request */
    public $addHotel;
    public $edit;

    /* Input */
    public $benefit;
    public $benefit_names; /* 추가 베네핏 */

    public $period; /* 기간 별 워딩*/
    public $period_count=1; /* 기간 개수 */
    public $period_benefit; /* 기간 별 베네핏 */
    public $period_benefit_names; /* 기간 별 추가 베네핏*/

    public $only_benefit; /* 기간 별 추가 베네핏*/
    public $only_benefit_names; /* 기간 별 추가 베네핏*/

    /* ORM */
    public $user;

    protected $listeners = [
        'benefitsEventSave'=>'submit'
    ];

    /* Validate*/
    public $rules = [
        'benefit_names'=>['max:50'],

        'period.0'=>['required', 'min:2', 'max:50'],
        'period.*'=>['required', 'min:2', 'max:50'],
        'period_benefit_names.*'=>['max:50'],
    ];

    public $messages = [
        'benefit_names.max'=>'추가 베네핏 은(는) :max자 이하 입니다',

        'period.*.required'=>'기간 은(는) 필수 사항 입니다',
        'period.*.min' => '기간 별 추가 베네핏 은(는) :min자 이상 입니다',
        'period.*.max' => '기간 은(는) :max자 이하 입니다',
        'period_benefit_names.*.max' => '기간 별 추가 베네핏 은(는) :max자 이하 입니다',
    ];


    public function mount()
    {
        if(auth()->check()) {
            $this->user = auth()->user();
            /* 공통 - 혜택*/
            $benefits = AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                ->whereHotelManagerId($this->user->id)
                ->whereNull('only')
                ->whereNull('period')
                ->whereNull('order')
                ->whereNull('name')
                ->whereNotNull('benefit_id')
                ->get();
            foreach ($benefits as $benefit) {
                if($benefit){
                    $this->benefit[$benefit->benefit_id] = $benefit->benefit_id;
                }
            }
            /* 공통 - 추가 혜택 */
            $benefit_names = AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                ->whereHotelManagerId($this->user->id)
                ->whereNull('benefit_id')
                ->whereNull('only')
                ->whereNull('period')
                ->whereNull('order')
                ->whereNotNull('name')
                ->first();
            $this->benefit_names=$benefit_names->name ?? null;

            /* 기간별 - 기간 */
            $periods = AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                ->whereHotelManagerId($this->user->id)
                ->whereNull('only')
                ->whereNotNull('period')
                ->whereNotNull('order')
                ->groupBy('period')
                ->get();
            foreach ($periods as $index=>$item){
                $this->period[$index] = $item->period;
            }
            $this->period_count=$periods->count()===0 ? 1 : $periods->count();
            /* 기간별 - 혜택 */
            $period_benefits = AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                ->whereHotelManagerId($this->user->id)
                ->whereNull('only')
                ->whereNull('name')
                ->whereNotNull('benefit_id')
                ->whereNotNull('period')
                ->whereNotNull('order')
                ->get();
            foreach ($period_benefits as $index=>$item){
                $this->period_benefit[$item->order][$item->benefit_id] = $item->benefit_id;
            }
            /* 기간별 - 추가 혜택 */
            $period_benefit_names = AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                ->whereHotelManagerId($this->user->id)
                ->whereNull('benefit_id')
                ->whereNull('only')
                ->whereNotNull('name')
                ->whereNotNull('period')
                ->whereNotNull('order')
                ->get();
            // ddd($period_benefit_names);
            foreach ($period_benefit_names as $index=>$item){
                $this->period_benefit_names[$index] = $item->name;
            }
            /* Only - 혜택 */
            $only_benefits = AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                ->whereHotelManagerId($this->user->id)
                ->whereOnly('1')
                ->whereNull('name')
                ->whereNull('order')
                ->whereNull('period')
                ->whereNotNull('benefit_id')
                ->get();
            foreach ($only_benefits as $index=>$item){
                $this->only_benefit[$item->benefit_id] = $item->benefit_id;
            }
            /* Only - 추가 혜택 */
            $only_benefit_names = AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                ->whereHotelManagerId($this->user->id)
                ->whereOnly('1')
                ->whereNull('benefit_id')
                ->whereNull('period')
                ->whereNull('order')
                ->whereNotNull('name')
                ->first();
            $this->only_benefit_names=$only_benefit_names->name ?? null;

        }
    }

    public function periodCount($type)
    {
        if($type === 'add'){
            $this->period_count++;
            AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('periodCountAdd')->whereNull('status')->update([
                'status'=>'확인'
            ]);
        }else if($type === 'sub'){
            try {
                AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                    ->whereHotelManagerId($this->user->id)->whereOrder($this->period_count - 1)->delete();
            } catch (\Exception $e) {
                Log::channel('slack-debug')->debug($e);
            }
            $this->period_count--;
        }
    }

    public function benefitCreate()
    {
        $this->validate([
            'benefit_names'=>['max:50']
        ], [
            'benefit_names.max'=>'추가 베네핏 은(는) :max자 이하 입니다'
        ]);
        if(isset($this->benefit)){
            foreach ($this->benefit as $key=>$item){
                if($item===false){
                    AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                        ->whereHotelManagerId($this->user->id)
                        ->whereBenefitId($key)
                        ->whereNull('only')
                        ->whereNull('order')
                        ->delete();
                }else{
                    AddHotelBenefit::updateOrCreate([
                        'add_hotel_id' => $this->addHotel->id,
                        'hotel_manager_id' => $this->user->id,
                        'only'=>null,
                        'order'=>null,
                        'benefit_id' => $item
                    ], [
                        'add_hotel_id' => $this->addHotel->id,
                        'hotel_manager_id' => $this->user->id,
                        'only'=>null,
                        'order'=>null,
                        'benefit_id' => $item
                    ]);
                }
            }
        }

        if($this->benefit_names!=="" && $this->benefit_names !== null){
            AddHotelBenefit::updateOrCreate([
                'add_hotel_id' => $this->addHotel->id,
                'hotel_manager_id' => $this->user->id,
                'only'=>null,
                'order'=>null,
                'benefit_id' => null
            ], [
                'add_hotel_id' => $this->addHotel->id,
                'hotel_manager_id' => $this->user->id,
                'only'=>null,
                'order'=>null,
                'benefit_id' => null,
                'name'=>$this->benefit_names
            ]);
        }elseif($this->benefit_names===""){
            AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                ->whereHotelManagerId($this->user->id)
                ->whereNull('only')
                ->whereNull('order')
                ->whereNull('benefit_id')
                ->whereNotNull('name')
                ->delete();
        }
    }

    public function periodCreate()
    {
        $rules = null;
        for ($i=0; $i<$this->period_count; $i++){
            $rules['period.'.$i] = ['required', 'min:2', 'max:50'];
            $rules['period_benefit_names.'.$i] = ['max:50'];
        }
        $validate = $this->validate($rules, [
            'period.*.required'=>'기간 은(는) 필수 사항 입니다',
            'period.*.min' => '기간 은(는) :min자 이상 입니다',
            'period.*.max' => '기간 은(는) :max자 이하 입니다',
            'period_benefit_names.*.max' => '기간 별 추가 베네핏 은(는) :max자 이하 입니다'
        ]);

        for ($i=0; $i<$this->period_count; $i++){

            if(isset($this->period_benefit[$i])){
                AddHotelBenefit::onlyTrashed()->whereAddHotelId($this->addHotel->id)
                    ->whereHotelManagerId($this->user->id)->whereOrder($i)
                    ->whereNull('name')->whereNull('only')
                    ->whereNotNull('period')->whereNotNull('benefit_id')->forceDelete();
                AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                    ->whereHotelManagerId($this->user->id)->whereOrder($i)
                    ->whereNull('name')->whereNull('only')
                    ->whereNotNull('period')->whereNotNull('benefit_id')->delete();
                foreach ($this->period_benefit[$i] as $key=>$item){
                    if(!$item===false){
                        AddHotelBenefit::create([
                            'add_hotel_id' => $this->addHotel->id,
                            'hotel_manager_id' => $this->user->id,
                            'only'=>null,
                            'order'=>$i,
                            'period'=>$this->period[$i],
                            'benefit_id' => $key
                        ]);
                    }
                }
            }

            if(isset($this->period_benefit_names[$i]) && $this->period_benefit_names[$i]!==null){

                AddHotelBenefit::onlyTrashed()->whereAddHotelId($this->addHotel->id)
                    ->whereHotelManagerId($this->user->id)->whereOrder($i)
                    ->whereNull('only')->whereNull('benefit_id')
                    ->whereNotNull('name')->whereNotNull('period')->forceDelete();
                AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                    ->whereHotelManagerId($this->user->id)->whereOrder($i)
                    ->whereNull('only')->whereNull('benefit_id')
                    ->whereNotNull('name')->whereNotNull('period')->delete();

                AddHotelBenefit::create([
                    'add_hotel_id' => $this->addHotel->id,
                    'hotel_manager_id' => $this->user->id,
                    'only'=>null,
                    'benefit_id'=>null,
                    'order'=>$i,
                    'period'=>$this->period[$i],
                    'name' => $this->period_benefit_names[$i]
                ]);
            }
        }
    }

    public function onlyBenefitCreate()
    {
        $this->validate([
            'only_benefit_names'=>['max:50']
        ], [
            'only_benefit_names.max'=>'호텔에삶 Only 추가 베네핏 은(는) :max자 이하 입니다'
        ]);

        AddHotelBenefit::onlyTrashed()->whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->whereOnly('1')
            ->whereNull('name')
            ->whereNull('order')
            ->whereNull('period')
            ->whereNotNull('benefit_id')
            ->forceDelete();
        AddHotelBenefit::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->whereOnly('1')
            ->whereNull('name')
            ->whereNull('order')
            ->whereNull('period')
            ->whereNotNull('benefit_id')
            ->delete();
        if(isset($this->only_benefit)){
            foreach ($this->only_benefit as $key=>$item){
                if(!$item===false){
                    AddHotelBenefit::create([
                        'add_hotel_id' => $this->addHotel->id,
                        'hotel_manager_id' => $this->user->id,
                        'only'=>'1',
                        'order'=>null,
                        'period'=>null,
                        'benefit_id' => $item
                    ]);
                }
            }
        }

        if($this->only_benefit_names!=="" && $this->only_benefit_names !== null){
            AddHotelBenefit::create([
                'add_hotel_id' => $this->addHotel->id,
                'hotel_manager_id' => $this->user->id,
                'only'=>'1',
                'order'=>null,
                'period'=>null,
                'benefit_id' => null,
                'name'=>$this->only_benefit_names
            ]);
        }elseif($this->only_benefit_names===""){
            AddHotelBenefit::whereAddHotelId($this->addHotel->id)
                ->whereHotelManagerId($this->user->id)
                ->whereOnly('1')
                ->whereNull('order')
                ->whereNull('period')
                ->whereNull('benefit_id')
                ->whereNotNull('name')
                ->delete();
        }
    }

    public function submit()
    {
        $this->benefitCreate(); /* 공통 */
        $this->periodCreate(); /* 기간 */
        $this->onlyBenefitCreate(); /* Only */

        $this->emitUp('coreItemsEditEvent');
    }

    public function backRedirect($tab)
    {
        return redirect()->route('hotel-entry.hotel', [ 'tab' => $tab, 'hotel'=>$this->addHotel->id]);
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);

        if(!Str::of($propertyName)->contains(['benefit.','period_benefit.']) || Str::of($propertyName)->contains('only_benefit.')){
            AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)->whereModel('AddHotelBenefit')->whereTarget($propertyName)->whereNull('status')->update([
                'status'=>'확인'
            ]);
        }
    }

    public function needToModifyCheck($target)
    {
        AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)->whereModel('AddHotelBenefit')->whereTarget($target)->whereNull('status')->update([
            'status'=>'확인'
        ]);
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.hotels.entry.benefits-edit');
	}
}
