<?php

namespace App\Http\Livewire\Order;

use App\PeriodPrice;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Calendar extends Component
{
    public $hotel;
    public $events;
    public $name='Barry';

    public $admin;

    public $logs = [];
    public $type;

    public $start_date, $end_date;
    public $period_ranges = [];
    public $periodPrices = [];
    public $impossibleDates = [];

    protected $listeners = [
        'schedulerDateReceive'=>'dateReceive',
        'schedulerDateRemove'=>'dateRemove',
        'schedulerDateDrop'=>'dateDrop',
        'schedulerReEventSourceGet'=>'reEventSourceGet',
        'calendarDateClick'=>'dateClick',
        'calendarDateCheck'=>'dateCheck',
        'CalendarShowEvent',
        'CalendarReShowEvents',
        'calendarUnSelect',
        'calendarDateClear',
        'calendarDateUpperClear',
    ];

    public function mount(): void
    {
        if(auth()->check()){
            $this->admin = auth()->user();
        }
        $this->emit('dateCheckVisible');
    }
    public function calendarDateClear(){
        $this->reset('start_date', 'end_date');
    }
    public function calendarDateUpperClear(){
        $this->reset('start_date', 'end_date');
        $this->emit("dateCheckClear"); /*해당 캘린더 상 선택 날자 표기 지우기*/
        $this->emitUp('CalendarDateClear');/*상위 입력 폼 입력값 지우기*/
    }
    public function dateClick($target, $date){
        $this->emitTo($target, 'CalendarDateClick', $date);
    }
    public function dateCheck($data){
        if($data['start_date']!==null ){
            $this->start_date = Carbon::parse($data['start_date']);
        }
        if($this->type==='month'){
            if( $data['end_date']!==null ){
                $this->end_date = Carbon::parse($data['end_date']);
            }
            if($data['start_date']!==null && $data['end_date']!==null ){
                $this->reset('period_ranges');
                $periodDates = CarbonPeriod::create($this->start_date, $this->end_date); // 선택 기간

                foreach ($periodDates aS $periodDate){
                    $this->period_ranges[]=$periodDate->format('Y-m-d');
                }
                $this->impossibleDates = [];
                foreach ($this->period_ranges as $checkDate){
                    if(!in_array($checkDate,$this->periodPrices)){
                        $this->impossibleDates[] = $checkDate;
                    }
                }
                if( isset($this->impossibleDates) && collect($this->impossibleDates)->count()>=1){
                    $this->reset('start_date','end_date');/* 해당 캘린더 상 선택 날자 지우기*/
                    $this->emit("dateCheckClear"); /*해당 캘린더 상 선택 날자 표기 지우기*/
                    $this->emitUp('CalendarDateClear');/*상위 입력 폼 입력값 지우기*/
                }else{
                    $this->emit("dateCheckBackground");
                    $this->emitUp('CalendarPossibleRoomType');/*상위 입력 폼 룸타입 처리 */
                }
            }
        }else{
            $this->reset('period_ranges');

            $this->impossibleDates = [];
            if(!in_array(Carbon::parse($this->start_date)->format('Y-m-d'),$this->periodPrices)){
                $this->impossibleDates[] = Carbon::parse($this->start_date)->format('Y-m-d');
            }

            if( isset($this->impossibleDates) && collect($this->impossibleDates)->count()>=1){
                $this->reset('start_date','end_date');/* 해당 캘린더 상 선택 날자 지우기*/
                $this->emit("dateCheckClear"); /*해당 캘린더 상 선택 날자 표기 지우기*/
                $this->emitUp('CalendarDateClear');/*상위 입력 폼 입력값 지우기*/
            }
        }
    }
    /* select 시 이벤트 추가 */
    public function CalendarShowEvent($event)
    {
        $this->events[]=$event;
        $this->emit("ShowEvent", $event ?? null);
    }
    /* left right 등 전체 이벤트 뷰 */
    public function CalendarReShowEvents()
    {
        $this->emit("ShowEvents", $this->events ?? null);
    }

    public function updatedName(): void
    {
        $this->emit("refreshCalendar");
    }

    /* 이벤트 삭제 후 재 표기 */
    public function calendarUnSelect(): void
    {
        $this->reset('events');
        $this->emit("FormModalPeriodRangesClear");
        $this->dispatchBrowserEvent('reEventSourceGet');
    }

    /* 이벤트 리소스 리로드 */
    public function reEventSourceGet(): void
    {
        $this->dispatchBrowserEvent('reEventSourceGet');
    }

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.order.calendar');
	}
}
