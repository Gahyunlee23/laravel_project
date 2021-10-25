<?php

namespace App\Http\Livewire\Hotels\Managers;

use Livewire\Component;

class InfoModify extends Component
{
    /* */

    /* Alpine*/
    public $type;


    public $test;

    public function typeChange($type)
    {
        $this->type = $type;
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.hotels.managers.info-modify');
	}
}
