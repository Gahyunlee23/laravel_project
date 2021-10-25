<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotelItem;
use App\AddHotelPeriod;
use Illuminate\Support\Str;
use Livewire\Component;

class Items extends Component
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
            $this->user = auth()->user();
            if($this->addHotel->method!==null){
                $this->method = $this->addHotel->method;
            }
        }
    }

    public function itemLoad()
    {
        $addHotelItemsPeriod = AddHotelPeriod::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->orderBy('order')->get();

        if($addHotelItemsPeriod->count()>=1){
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
    }

    public function submit()
    {
        $loadingDate = now();
        /* 룰 리셋 */
        $this->rules =[
            'method'=>['required'],
            'periods_value.*'=>['required', 'max:30', 'min:2'],
        ];
        for($o=0;$o<$this->addHotel->roomTypes->count();$o++){
            for($i=0;$i<$this->period_count;$i++){
                if($this->method === '수수료'){
                    $this->rules['sale_prices.'.$o.'.'.$i]=['required'];
                    $this->rules['fees.'.$o.'.'.$i]=['required', 'integer', 'min:10', 'max:100'];
                }else{
                    $this->rules['prices.'.$o.'.'.$i]=['required'];
                }
            }
        }
        $this->validate($this->rules);

        $this->addHotel->method = $this->method;
        $this->addHotel->save();


        $addHotelPeriods = false;

        /* 이전 데이터 백업 삭제 */
        AddHotelPeriod::whereAddHotelId($this->addHotel->id)
            ->whereHotelManagerId($this->user->id)
            ->delete();
        for($i=0;$i<$this->period_count;$i++){
            $addHotelPeriods = AddHotelPeriod::create([
                'add_hotel_id'=>$this->addHotel->id,
                'hotel_manager_id'=>$this->user->id,
                'order'=>$i,
                'name'=>$this->periods_value[$i]
            ]);
        }

        if($addHotelPeriods){
            /* 이전 데이터 백업 삭제 */
            AddHotelItem::whereAddHotelId($this->addHotel->id)
                ->whereHotelManagerId($this->user->id)
                ->delete();

            for($o=0;$o<$this->addHotel->roomTypes->count();$o++){
                $num = 0;
                for($i=0;$i<$this->period_count;$i++){
                    if($this->method === '수수료'){
                        AddHotelItem::create([
                            'add_hotel_id'=>$this->addHotel->id,
                            'hotel_manager_id'=>$this->user->id,
                            'order'=>$num,
                            'room_type_id'=>$this->addHotel->roomTypes->get($o)->id,
                            'period'=>$this->periods_value[$i],
                            'sale_price'=>Str::of($this->sale_prices[$o][$i])->replace(',',''),
                            'fee'=>Str::of($this->fees[$o][$i])->replace(',',''),
                            'price'=>Str::of($this->prices[$o][$i])->replace(',','')
                        ]);
                    }else{
                        AddHotelItem::create([
                            'add_hotel_id'=>$this->addHotel->id,
                            'hotel_manager_id'=>$this->user->id,
                            'order'=>$num,
                            'room_type_id'=>$this->addHotel->roomTypes->get($o)->id,
                            'period'=>$this->periods_value[$i],
                            'sale_price'=>null,
                            'fee'=>null,
                            'price'=>Str::of($this->prices[$o][$i])->replace(',',''),
                        ]);
                    }
                    $num++;
                }
            }
        }
        //ddd($loadingDate->diffInRealMicroseconds(now()));
        if($loadingDate->diffInRealMicroseconds(now()) <= 500000){
            usleep(500000-$loadingDate->diffInRealMicroseconds(now()));
        }
        return redirect()->route('hotel-entry.hotel', ['tab' => 5, 'hotel'=>$this->addHotel->id]);
    }


    public function formatNumber($target, $a1, $a2){
        if(isset($this->{$target}[$a1][$a2])&& $this->{$target}[$a1][$a2] !== null && $this->{$target}[$a1][$a2] !== ''){
            $bank_account=$this->{$target}[$a1][$a2];
            $bank_account = preg_replace('/[^0-9]+/', '', $bank_account);
            if($this->method === '수수료'){
                if($target === 'sale_prices'){
                    $this->{$target}[$a1][$a2]= number_format($bank_account === '' ? 0 : $bank_account);
                }
                if($target === 'fees'){
                    if($bank_account>100){
                        $bank_account = 15;
                    }
                    $this->{$target}[$a1][$a2]=$bank_account === '' ? 10 : $bank_account;
                }
            }else{
                if($target === 'prices'){
                    $this->{$target}[$a1][$a2]= number_format($bank_account === '' ? 0 : $bank_account);
                }
            }
        }else{
            $bank_account='';
            $this->{$target}[$a1][$a2] = $bank_account;
        }
        if($this->method === '수수료'){
            $this->priceCalc($a1,$a2);
        }
    }

    public function priceCalc($a1, $a2)
    {
        if(isset($this->sale_prices[$a1][$a2])&& isset($this->fees[$a1][$a2])
            && $this->sale_prices[$a1][$a2]!==null && $this->fees[$a1][$a2]!==null
            && $this->sale_prices[$a1][$a2]!=='' && $this->fees[$a1][$a2]!==''){
            $n1 = preg_replace('/[^0-9]+/', '', $this->sale_prices[$a1][$a2]);
            $n2 = preg_replace('/[^0-9]+/', '', $this->fees[$a1][$a2]);
            $this->prices[$a1][$a2] = number_format($n1-(($n1*1)*(($n2*1)/100)));
        }
    }

    public function periodRemove($index){
        $this->periods_value=collect($this->periods_value)->forget($index);
        $this->period_count = collect($this->periods_value)->count();
        if($this->period_count<=4){
            $this->editing = false;
        }
    }
    public function periodCount($type)
    {
        if($type === 'add'){
            $this->periods_value[]='';
            $this->period_count = collect($this->periods_value)->count();
        }
    }

    public function editingChange(){
        $this->editing = !$this->editing;
    }

    public function backRedirect($tab)
    {
        return redirect()->route('hotel-entry.hotel',['hotel'=>$this->addHotel->id,'tab' => $tab]);
    }
    public function updatedMethod($value)
    {
        $this->resetErrorBag();
    }
    public function updated($propertyName){
        $this->validateOnly($propertyName);

        $this->error_bool = false;
    }
    /**
     *Get the view / contents that represent the component.
     *
     *@return\Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.hotels.entry.items');
    }
}
