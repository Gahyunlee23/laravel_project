<?php

namespace App\Http\Livewire\Admin\Reservation;

use App\ReservationCancel;
use App\ReservationModify;
use Livewire\Component;

class Application extends Component
{
    public $list;
    public $tab = 'modify';

    protected $listeners = ['tabChangeEvent'];

    public function tabChangeEvent($tab): void
    {
        $this->tab=$tab;
        $this->reList();
    }
    public function mount(): void
    {
        $this->reList();
    }
    public function reList(): void
    {
        switch ($this->tab){
            case 'modify' :
                $this->list = ReservationModify::all();
                break;
            case 'cancel' :
                $this->list = ReservationCancel::all();
                break;
        }
    }

    public function render()
    {
        return view('livewire.admin.reservation.application');
    }
}
