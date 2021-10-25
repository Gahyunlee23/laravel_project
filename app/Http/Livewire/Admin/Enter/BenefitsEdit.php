<?php

namespace App\Http\Livewire\Admin\Enter;

use App\AddHotelBenefit;
use App\User;
use Livewire\Component;

class BenefitsEdit extends Component
{

    /* Request */
    public $addHotel;

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

    public function mount()
    {
        if(auth()->check()) {
            if(auth()->user()->hasPermissionTo('getListEnterHotel')){
                $this->user = User::find($this->addHotel->hotel_manager_id);
            }else{
                $this->user = auth()->user();
            }
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
                ->get();
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
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.enter.benefits-edit');
	}
}
