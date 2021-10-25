<?php

namespace App\Http\Livewire\Alert\Toggle;

use Livewire\Component;

class Notification extends Component
{
    public $data;

    public function check(){
        if(auth()->check()){
            foreach (\App\Notification::whereUserId(auth()->user()->id)->whereForwardedDt(null)->get() as $item) {
                $this->dispatchBrowserEvent('notice', ['type' => $item->type,'text'=>$item->content,'time'=>$item->timer ?? 2000]);
                $item->forwarded_dt = now();
                $item->save();
            }
        }
    }

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.alert.toggle.notification');
	}
}
