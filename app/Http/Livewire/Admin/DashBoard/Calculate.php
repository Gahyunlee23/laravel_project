<?php

namespace App\Http\Livewire\Admin\DashBoard;

use Livewire\Component;

class Calculate extends Component
{
    protected $listeners = [
        'adminDashBoardCalculateLoadEvent' => 'load'
    ];
    public $load = false;

    public function load(): void
    {
        $this->load = true;
    }

    public function render()
    {
        return view('livewire.admin.dash-board.calculate');
    }
}
