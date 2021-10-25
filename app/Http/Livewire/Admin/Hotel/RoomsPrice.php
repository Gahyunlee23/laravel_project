<?php

namespace App\Http\Livewire\Admin\Hotel;

use Livewire\Component;

class RoomsPrice extends Component
{
    /* Request */
    public $item;
    public $list_index;
    public $rooms;

    public $fileTitles=['메인','리뷰','서브1','서브2'];

    /* Alpine */
    public $show = false;

    public function mount(){
        if($this->item){
            $this->rooms = $this->item->rooms()->whereDisable('N')->whereVisible('1')->get();
        }
    }

    public function dataLoad(){
        $this->show = !$this->show;
    }
    /**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.admin.hotel.rooms-price');
	}
}
