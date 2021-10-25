<?php

namespace App\Http\Livewire\Admin\Hotel;

use Livewire\Component;

class HotelAndArea extends Component
{
    /* Request */
    public $hotel;
    public $list_index;

    public $fileTitles=['메인','리뷰','서브1','서브2'];

    /* Data */
    public $item;

    public function dataLoad(){
        $this->item = $this->hotel;
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.hotel.hotel-and-area');
	}
}
