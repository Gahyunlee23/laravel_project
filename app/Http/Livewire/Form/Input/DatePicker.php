<?php

namespace App\Http\Livewire\Form\Input;

use Livewire\Component;

class DatePicker extends Component
{
    public $model;

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.form.input.date-picker');
	}
}
