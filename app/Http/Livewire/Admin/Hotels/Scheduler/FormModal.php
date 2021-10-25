<?php

namespace App\Http\Livewire\Admin\Hotels\Scheduler;

use App\Benefit;
use App\HotelRoomType;
use App\Http\Livewire\Admin\Hotel\RoomTypes;
use App\Option;
use App\PeriodPrice;
use App\Scheduler;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\Traits\Creator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FormModal extends Component
{
    /* Request */
    public $hotel;
    public $schedulers;
    public $period_ranges;

    /* Form Input */
    public $period_type = 'price';
    public $roomFor = [0];
    public $form;
    public $benefit;

    public $options;
    public $benefits;
    public $colors;

    /* Data */
    public $roomTypes;
    public $roomTypePeriod;

    /* Alpine */
    public $discount_method = '%';


    protected $listeners = [
        'CalendarSelectEvents',
        'FormModalPeriodSorting'=>'periodSorting',
        'FormModalPeriodRangesClear'=>'periodRangesClear'
    ];

    public function mount()
    {
        $this->form['start_time'] = '00:00';
        $this->form['end_time'] = '23:59';
        $this->colors['color'] = '#849773';
        $this->colors['textColor'] = '#FFFFFF';

        $this->roomTypes = $this->hotel->visibleRoomTypes;
        $this->roomTypePeriodSet();
        $this->benefitsLoad();
    }

    public function optionsLoad()
    {
        $this->options = Option::whereHotelId($this->hotel->id);
    }

    public function benefitsLoad()
    {
        $this->benefits = Benefit::whereHotelId($this->hotel->id)->groupBy('name')->whereNull('option_id')->get();
    }
    public function benefitPush($index,$i,Benefit $benefit)
    {
        $this->options['benefits'][$index][$i][$benefit->id] = $benefit;
    }
    public function benefitRemove($index,$i,Benefit $benefit)
    {
        $this->options['benefits'][$index][$i] = collect($this->options['benefits'][$index][$i])->forget($benefit->id);
    }

    public function benefitSaving($index,$i){
        $this->resetErrorBag('benefit.name.*');
        $this->validate([
            'benefit.name.'.$index.'.'.$i=> ['required',
                Rule::unique('benefits','name')->where(function ($query) use($index,$i){
                    return $query->where('hotel_id', $this->hotel->id);
                })
            ]
        ],[
            'benefit.name.'.$index.'.'.$i.'.required'=> '혜택명 입력해주세요',
            'benefit.name.'.$index.'.'.$i.'.unique'=> '이미 추가된 혜택입니다',
        ]);
        Benefit::updateOrCreate([
            'hotel_id'=>$this->hotel->id,
            'name'=>$this->benefit['name'][$index][$i],
        ],[
            'hotel_id'=>$this->hotel->id,
            'admin_id'=>auth()->user()->id,
            'name'=>$this->benefit['name'][$index][$i],
        ]);
        $this->reset('benefit');
        $this->benefitsLoad();
    }

    public function roomTypePeriodSet()
    {
        $this->roomTypePeriod=null;
        foreach ($this->hotel->visibleRoomTypes as $index => $roomType){
            $this->roomTypePeriod[$index] = [];
        }
    }

    public function SchedulerSubmit()
    {
        $this->resetErrorBag();
        $rules = null;
        $rules['form.start_time']=['required', 'before:form.end_time'];
        $rules['form.end_time']=['required', 'after:form.start_time'];
        foreach ($this->roomTypes as $index => $roomType) {
            foreach ($this->roomTypePeriod[$index] as $i => $item) {
                $rules['form.'.$index.'.'.$i.'.date']=['required','integer','min:0'];
                $rules['form.'.$index.'.'.$i.'.price']=['required','integer','min:0'];
                $rules['form.'.$index.'.'.$i.'.sale_price']=['required','integer','min:0'];
                $rules['form.'.$index.'.'.$i.'.refund']=['required','integer','min:0'];
            }
        }
        $this->validate($rules, [
            'form.start_time.required' => '세팅 시작 시간 필수 정보 입니다',
            'form.start_time.before' => '세팅 시작 시간은 종료 이전 입니다',
            'form.end_time.required' => '세팅 종료 시간 필수 정보 입니다',
            'form.end_time.after' => '세팅 종료 시간은 시작 이후 입니다',

            'form.*.*.date.required'=>'박 수 필수 정보 입니다',
            'form.*.*.price.required'=>'가격은 필수 정보 입니다',
            'form.*.*.sale_price.required'=>'실 판매가는 필수 정보 입니다',
            'form.*.*.refund.required'=>'환불금은 필수 정보 입니다',

            'form.*.*.date.integer'=>'박 수는 숫자 입니다',
            'form.*.*.price.integer'=>'가격은 숫자 입니다',
            'form.*.*.sale_price.integer'=>'실 판매가는 숫자 입니다',
            'form.*.*.refund.integer'=>'환불금은 숫자 입니다',

            'form.*.*.date.min'=>'박 수는 :min 이상 입니다',
            'form.*.*.price.min'=>'가격은 :min 이상 입니다',
            'form.*.*.sale_price.min'=>'실 판매가는 :min 이상 입니다',
            'form.*.*.refund.min'=>'환불금은 :min 이상 입니다',
        ]);

        $scheduler = Scheduler::create([
            'hotel_id'=>$this->hotel->id,
            'admin_id'=>auth()->user()->id,
            'bg_color'=>$this->colors['color'] ?? '#849773',
            'text_color'=>$this->colors['textColor'] ?? '#FFFFFF',
        ]);

        $periodPrice = null;
        $period_ranges=array_unique($this->period_ranges);

        if($this->period_type === 'tour'){
            foreach ($period_ranges aS $periodDate){
                PeriodPrice::updateOrCreate([
                    'hotel_id'=>$this->hotel->id,
                    'type'=>$this->period_type,
                    'range_d'=>$periodDate
                ], [
                    'hotel_id'=>$this->hotel->id,
                    'scheduler_id'=>$scheduler->id,
                    'admin_id'=>auth()->user()->id,
                    'type'=>$this->period_type,
                    'range_d'=>$periodDate,
                    'start_time'=>$this->form['start_time'].':00',
                    'end_time'=>$this->form['end_time'].':59',
                ]);
            }
        }

        if($this->period_type === 'price'){
            foreach ($this->roomTypes as $index => $roomType){
                foreach ($this->roomTypePeriod[$index] as $i=>$item){
                    foreach (collect($period_ranges)->chunk(5) as $chunk){
                        foreach ($chunk as $periodDate){
                            if(isset($this->form[$index][$i]['date'], $this->form[$index][$i]['price'])){
                                $periodPrice[$index][$i] = PeriodPrice::updateOrCreate([
                                    'hotel_id'=>$this->hotel->id,
                                    'room_type_id'=>$roomType->id,
                                    'room_type_name'=>$roomType->name ?? null,
                                    'type'=>$this->period_type,
                                    'range_d'=>$periodDate,
                                    'date'=>$this->form[$index][$i]['date'],
                                ], [
                                    'hotel_id'=>$this->hotel->id,
                                    'scheduler_id'=>$scheduler->id,
                                    'room_type_id'=>$roomType->id,
                                    'room_type_name'=>$roomType->name ?? null,
                                    'admin_id'=>auth()->user()->id,
                                    'type'=>$this->period_type,
                                    'range_d'=>$periodDate,
                                    'date'=>$this->form[$index][$i]['date'],
                                    'price'=>$this->form[$index][$i]['price'],
                                    'discount'=>$this->form[$index][$i]['discount'],
                                    'sale_price'=>$this->form[$index][$i]['sale_price'],
                                    'refund'=>$this->form[$index][$i]['refund'],
                                    'start_time'=>$this->form['start_time'].':00',
                                    'end_time'=>$this->form['end_time'].':59',
                                ]);
                                $this->optionsSubmit($periodPrice[$index][$i], $index, $i);
                            }
                        }
                    }
                }
            }
        }

        $this->reset('form', 'schedulers', 'period_ranges', 'options');
        $this->roomTypePeriodSet();

        $this->form['start_time'] = '00:00';
        $this->form['end_time'] = '23:59';

        //$this->emitTo('admin.hotels.scheduler.options','schedulerSaveEvent', $periodPrice);

        $this->emitTo('calendar.fullcalendar','schedulerReEventSourceGet');
        $this->emitTo('calendar.fullcalendar','calendarUnSelect');
        $this->emitTo('admin.hotels.scheduler.core','schedulerModalClose');

    }

    public function periodRangesClear()
    {
        $this->reset('form','schedulers','period_ranges');
    }

    public function timerDefaultSet(){
        $this->form['start_time'] = '00:00';
        $this->form['end_time'] = '23:59';
    }

    public function optionsSubmit(PeriodPrice $periodPrice,$index, $i)
    {
        if(isset($this->options['benefits'][0][$i])){
            Option::whereHotelId($this->hotel->id)->wherePeriodPriceId($periodPrice->id)->delete();
            $option = Option::create([
                'hotel_id'=>$this->hotel->id,
                'period_price_id'=>$periodPrice->id,
                'admin_id'=>auth()->user()->id,
                'memo'=>$this->options['memo'][$index][$i] ?? null,
                'disabled'=>'0',
            ]);
            foreach (collect($this->options['benefits'][$index][$i])->chunk(5) as $chunk) {
                foreach ($chunk as $item) {
                    Benefit::create([
                        'hotel_id'=>$this->hotel->id,
                        'admin_id'=>auth()->user()->id,
                        'option_id'=>$option->id,
                        'name'=>$item['name']
                    ]);
                }
            }
        }else{
            Option::whereHotelId($this->hotel->id)->wherePeriodPriceId($periodPrice->id)->delete();
        }
    }

//    public function updated($propertyName){
//        if(Str::of($propertyName)->containsAll(['form','price'])){
//            //ddd($propertyName);
//        }
//    }

    public function calcPrice($type, $index, $i)
    {
        switch ($type){
            case 'price' :
            case 'discount' :
                if(isset($this->form[$index][$i]['discount'],$this->form[$index][$i]['price'])  && $this->form[$index][$i]['price']!=='' &&  $this->form[$index][$i]['discount']!==''){
                    if($this->form[$index][$i]['discount'] >= 100) {
                        $this->form[$index][$i]['sale_price'] = $this->form[$index][$i]['price']-$this->form[$index][$i]['discount'];
                        $this->discount_method = '원';
                    }elseif($this->form[$index][$i]['discount'] < 0){
                        $this->form[$index][$i]['discount']=0;
                        $this->discount_method = '%';
                    }elseif($this->form[$index][$i]['discount']!==''){
                        $this->form[$index][$i]['sale_price'] = ceil($this->form[$index][$i]['price']-($this->form[$index][$i]['price']*$this->form[$index][$i]['discount']/100));
                        $this->discount_method = '%';
                    }
                }else if(isset($this->form[$index][$i]['discount'],$this->form[$index][$i]['price']) && $this->form[$index][$i]['price'] === '' && $this->form[$index][$i]['discount']){
                    $this->form[$index][$i]['sale_price']=0;
                    $this->discount_method = '%';
                }else if(isset($this->form[$index][$i]['price']) && $this->form[$index][$i]['price'] !== ''){
                    $this->form[$index][$i]['sale_price'] = $this->form[$index][$i]['price'];
                    $this->discount_method = '%';
                }
            break;
        }
    }
    public function checkFormDate($key_index, $key_i)
    {
        $rules = null;
        $message = null;
        foreach ($this->roomTypes as $index=>$roomType){
            foreach ($this->roomTypePeriod[$index] as $i=>$roomTypePeriod){
                if($i!==0){
                    $rules['form.'.$index.'.'.$i.'.date'] = ['required', 'gt:form.'.$index.'.'.($i-1).'.date'];
                    $message['form.'.$index.'.'.$i.'.date.required'] = '필수 입력값 입니다';
                    $message['form.'.$index.'.'.$i.'.date.gt'] = '이전 박 수 보다 커야 됩니다';
                }
            }
        }
        if(collect($this->period_ranges)->count()===1){
            $roomType = $this->roomTypes->get($key_index);
            if(PeriodPrice::whereHotelId($this->hotel->id)
                    ->where('date', '=', $this->form[$key_index][$key_i]['date'])
                    ->whereRangeD($this->period_ranges[0])->where(function ($q) use($roomType) {
                        $q->where('room_type_id', '=', $roomType->id)->orWhere('room_type_name', '=', $roomType->name);
                    })->count() >= 1){
                $period = PeriodPrice::whereHotelId($this->hotel->id)->where('date', '=', $this->form[$key_index][$key_i]['date'])
                    ->whereRangeD($this->period_ranges[0])->where(function ($q) use($roomType) {
                    $q->where('room_type_id', '=', $roomType->id)->orWhere('room_type_name', '=', $roomType->name);
                })->latest()->first();

                $this->form[$key_index][$key_i]['price']=$period->price ?? 0;
                $this->form[$key_index][$key_i]['discount']=$period->discount ?? 0;
                $this->form[$key_index][$key_i]['sale_price']=$period->sale_price ?? 0;
                $this->form[$key_index][$key_i]['refund']=$period->refund ?? 0;
                $this->options['benefits'][$key_index][$key_i] = null;
                if(isset($period->option)){
                    if($period->option->benefits->count()>=1){
                        foreach ($period->option->benefits as $benefit){
                            $this->options['benefits'][$key_index][$key_i][$benefit->id] = $benefit;
                        }
                    }
                    //ddd($period->option, $period->option->benefits);
                }
            }
        }

        if($rules !== null && $message !== null){
            $this->validate($rules,$message);
        }
    }

    public function roomTypePeriodRemove($index, $i)
    {
        $this->resetErrorBag();
        $this->options['benefits'][$index]=null;
        $this->roomTypePeriod[$index] = collect($this->roomTypePeriod[$index])->forget($i)->filter()->values();
        if(isset($this->form[$index])){
            $this->form[$index]=collect($this->form[$index])->forget($i)->filter()->values();

        }
    }
    public function roomTypePeriodAdd($index)
    {
        $this->roomTypePeriod[$index][] = 'in';
    }

    public function roomTypePeriodOptions($index, $i)
    {
        ddd($this->hotel, $this->schedulers, $index, $i);

    }
//    public function roomTypeSelect(HotelRoomType $roomType)
//    {
//        $this->roomTypes = $roomType;
//    }

    public function defaultDataSet()
    {
        if(isset($this->schedulers) && $this->schedulers !== null){
            foreach ($this->schedulers as $index=>$item){
                $this->form[$index]['start']['date'] = Carbon::parse($item['startStr'])->format('Y-m-d');
                $this->form[$index]['end']['date'] = Carbon::parse($item['endStr'])->subSecond()->format('Y-m-d');
            }
        }
    }

    public function periodSorting()
    {
        $this->period_ranges=array_values(Arr::sort(array_unique($this->period_ranges), function ($value) {
            return $value;
        }));
    }

    public function CalendarSelectEvents($events)
    {
        foreach ($events as $event){
            $this->schedulers[] = $event;
        }

        if(isset($this->schedulers) && $this->schedulers !== null) {
            foreach ($this->schedulers as $scheduler_index => $item) {
               // ddd($item);
                $start_date = Carbon::parse($item['startStr']);
                $end_date = Carbon::parse($item['endStr'])->subSecond();
                $periodDates = CarbonPeriod::create($start_date, $end_date);
                foreach ($periodDates aS $periodDate){
                    $this->period_ranges[]=$periodDate->format('Y-m-d');
                }
            }
        }
        $this->period_ranges=array_unique($this->period_ranges);

        $this->defaultDataSet();
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.hotels.scheduler.form-modal');
	}
}
