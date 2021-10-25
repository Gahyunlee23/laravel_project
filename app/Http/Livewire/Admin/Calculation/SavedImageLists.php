<?php

namespace App\Http\Livewire\Admin\Calculation;

use Livewire\Component;

class SavedImageLists extends Component
{
    public $open = false;
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.calculation.saved-image-lists');
	}
}
