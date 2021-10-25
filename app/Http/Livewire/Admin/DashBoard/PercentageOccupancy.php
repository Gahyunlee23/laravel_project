<?php

namespace App\Http\Livewire\Admin\DashBoard;

use Livewire\Component;

class PercentageOccupancy extends Component
{

    protected $listeners = [
        'PercentageOccupancyCalculateLoadEvent' => 'load'
    ];
    public $load = false;

    public function load(): void
    {
        $this->load = true;
    }

    /**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.dash-board.percentage-occupancy');
	}
}
