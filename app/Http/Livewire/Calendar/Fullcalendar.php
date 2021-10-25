<?php

namespace App\Http\Livewire\Calendar;

use App\PeriodPrice;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Fullcalendar extends Component
{
    public $hotel;
    public $events;
    public $name='Barry';
    public $admin;
    public $logs = [];

    protected $listeners = [
        'schedulerDateReceive'=>'dateReceive',
        'schedulerDateRemove'=>'dateRemove',
        'schedulerDateDrop'=>'dateDrop',
        'schedulerReEventSourceGet'=>'reEventSourceGet',
        'CalendarShowEvent',
        'CalendarReShowEvents',
        'calendarUnSelect',
    ];

    public function mount(): void
    {
        if(auth()->check()){
            $this->admin = auth()->user();
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


    /* Get Property Start */
    public function getNamesProperty(): array
    {
        /*return [
            'Barry',
            'Taylor',
            'Caleb',
        ];*/
        return [];
    }

    public function getTasksProperty(): array
    {
        /*switch ($this->name) {
            case 'Barry':
                return ['Barry', 'test1'];
            case 'Taylor':
                return ['Taylor', 'test2'];
            case 'Caleb':
                return ['Caleb', 'test3'];
        }*/

        return [];
    }
    /* Get Property End */


    /* Emit function Start */
    public function dateReceive($event): void
    {
        $this->logs[] = 'eventReceive: ' . print_r($event, true);
    }
    public function dateRemove($event): void
    {
        try {
            PeriodPrice::whereId($event['extendedProps']['periodPrice'])
                ->whereHotelId($this->hotel->id)
                ->whereSchedulerId($event['extendedProps']['scheduler'])
                ->whereRangeD($event['extendedProps']['range_d'])
                ->wherePrice($event['extendedProps']['price'])
                ->delete();
        } catch (\Exception $e) {
            Log::channel('slack-debug')->debug($e);
        }
    }

    public function dateDrop($event, $oldEvent): void
    {
        $this->logs[] = 'eventDrop: ' . print_r($oldEvent, true) . ' -> ' . print_r($event, true);

        PeriodPrice::whereSchedulerId($oldEvent['extendedProps']['scheduler'])
            ->whereId($oldEvent['extendedProps']['periodPrice'])
            ->limit(1)
            ->update([
                'range_d'=>$event['start']
            ]);
    }
    /* Emit function END */

    public function render()
    {
        return view('livewire.calendar.fullcalendar');
    }
}
