<?php

namespace App\Http\Livewire\Admin\Enter;

use App\AddHotelItem;
use App\AddHotelNeedToModify;
use App\AddHotelPeriod;
use App\User;
use Livewire\Component;

class ItemsEdit extends Component
{
    /* Request */
    public $addHotel;
    /* ORM */
    public $user;

    /* Input */
    public $method = '입금가';
    public $sale_prices; /* 판매가 */
    public $fees;/* 수수료 */
    public $prices;/* 최종 판매금 */

    public $count;

    /* Alpine */
    public $editing = false;
    public $error_bool=false;
    public $periods =[
        '1주 (6박 7일 ~ 12박 13일)',
        '2주 (13박 14일 ~ 19박 20일)',
        '3주 (20박 21일 ~ 28박 29일)',
        '1달 (29박 30일 ~ 30박 31일)',
    ];
    public $periods_value =[
        '1주 (6박 7일 ~ 12박 13일)',
        '2주 (13박 14일 ~ 19박 20일)',
        '3주 (20박 21일 ~ 28박 29일)',
        '1달 (29박 30일 ~ 30박 31일)',
    ];
    public $period_count ;

    /* Validate*/
    public $rules =[
        'method'=>['required'],
        'periods_value.*'=>['required', 'max:30', 'min:2'],
    ];


    public function mount()
    {
        if(auth()->check()) {
            if(auth()->user()->hasPermissionTo('getListEnterHotel')){
                $this->user = User::find($this->addHotel->hotel_manager_id);
            }else{
                $this->user = auth()->user();
            }
            if($this->addHotel->method!==null){
                $this->method = $this->addHotel->method;
            }
        }
    }

    public function updated($propertyName)
    {
        if($propertyName === 'method'){
            $this->countCheck();
        }
    }

    public function countCheck()
    {
        $this->count = null ;
        if($this->method === '입금가'){
            for($i = 0; $i < $this->period_count; $i++){
                foreach($this->addHotel->roomTypes as $index => $room_type){
                    $this->count[$index][$i] = AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)
                        ->whereModel('AddHotelItem')
                        ->where('target', 'Like', 'prices.'.$index.'.'.$i)->count();
                }
            }
        }
        if($this->method === '수수료'){
            for($i = 0; $i < $this->period_count; $i++){
                foreach($this->addHotel->roomTypes as $index => $room_type){
                    $this->count[$index][$i] = AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)
                        ->whereModel('AddHotelItem')
                        ->where(function ($q) use ($index,$i){
                            $q->where('target', 'Like', 'sale_prices.'.$index.'.'.$i);
                        })
                        ->orWhere(function ($q) use ($index,$i){
                            $q->where('target', 'Like', 'fees.'.$index.'.'.$i);
                        })
                        /*->orWhere(function ($q) use ($index,$i){
                            $q->where('target', 'Like', 'prices.'.$index.'.'.$i)->whereNull('status');
                        })*/->count();
                }
            }
        }
        $count_tmp = [];
        if($this->count !== null){
            foreach ($this->count as $item){
                foreach ($item as $i=>$tem){
                    if(!isset($count_tmp[$i])){
                        $count_tmp[$i]=0;
                    }
                    if($count_tmp[$i]<$tem){
                        $count_tmp[$i]=$tem;
                    }
                }
            }
        }
        $this->count=$count_tmp;
    }

    public function itemLoad()
    {
        $addHotelItemsPeriod = AddHotelPeriod::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->orderBy('order')->get();

        if($addHotelItemsPeriod){
            $this->periods_value = $addHotelItemsPeriod->pluck('name');
        }

        $addHotelItems = AddHotelItem::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->orderBy('room_type_id')->get();

        foreach ($addHotelItemsPeriod as $periodIndex => $period){
            foreach ($addHotelItems
                         ->skip($periodIndex*$addHotelItemsPeriod->count())
                         ->take($addHotelItemsPeriod->count()) as $itemIndex=>$item){

                $this->sale_prices[$periodIndex][$item->order] = number_format($item->sale_price);
                $this->fees[$periodIndex][$item->order] = $item->fee;
                $this->prices[$periodIndex][$item->order] = number_format($item->price);
            }
        }
        $this->period_count = collect($this->periods_value)->count();
        $this->countCheck();
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.enter.items-edit');
	}
}
