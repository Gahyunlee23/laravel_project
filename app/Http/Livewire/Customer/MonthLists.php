<?php

namespace App\Http\Livewire\Customer;

use App\HotelReservation;
use Livewire\Component;

class MonthLists extends Component
{
    public $readyToLoad = false;
    public $lists;
    public $type;

    protected $listeners = ['viewPaymentListsEvent' => 'loadLists'];

    public function loadLists(): void
    {
        $this->readyToLoad = true;
        $this->dispatchBrowserEvent('https-url-state-change',['tab'=>'month-lists']);
    }
    public function mount(){

    }
    public function render()
    {
        switch ($this->type){
            case 'unread' :
                $this->lists = auth()->user()->month_lists->where('read_at', '=', null);
                break;
            case 'all' :
            default :
                $this->lists = auth()->user()->month_lists;
                break;
        }
        return view('livewire.customer.month-lists', [
            'month_lists' => $this->readyToLoad ? $this->lists : []
        ]);
    }

    public function read($type,$id)
    {
        if($type === 'read'){
            HotelReservation::where('id','=',$id)->where('type', '=', 'month')->update(['read_at'=>now()]);
        }
        if($type === 'cancel'){
            HotelReservation::where('id','=',$id)->where('type', '=', 'month')->update(['read_at'=>null]);
        }
        $this->emit('listCountReCountEvent');
    }

}
