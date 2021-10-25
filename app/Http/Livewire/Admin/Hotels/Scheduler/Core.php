<?php

namespace App\Http\Livewire\Admin\Hotels\Scheduler;

use Livewire\Component;

class Core extends Component
{
    public $hotel;
    public $modal = false;

    public $events;

    protected $listeners = [
        'schedulerModalOpen'=>'modalOpen',
        'schedulerModalClose'=>'modalClose',
        'schedulerDateSelect'=>'dateSelect',
    ];

    public function mount()
    {

    }

    /* Listeners Emit function Start */
    public function dateSelect($event): void
    {
        $events[] = $event;
        //ddd($events);
        $this->emitTo('calendar.fullcalendar', 'CalendarShowEvent', $event);
        $this->emitTo('admin.hotels.scheduler.form-modal', 'CalendarSelectEvents', $events);
        //ddd($events);
    }

    public function modalOpen(): void
    {
        $this->modal = true;
        $this->emitTo('admin.hotels.scheduler.form-modal', 'FormModalPeriodSorting');
    }

    public function modalClose(): void
    {
        $this->modal = false;
    }
    /* Emit function End */
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.hotels.scheduler.core');
	}
}
