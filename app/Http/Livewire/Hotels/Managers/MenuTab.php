<?php

namespace App\Http\Livewire\Hotels\Managers;

use Livewire\Component;

class MenuTab extends Component
{
    /* Request */

    /* Response */

    /* Data */

    /* Alpine */
    public $menus;
    public $index;

    protected $listeners = [
        'menuTabChange'
    ];

    public function mount($index){
        $this->index = $index;
    }

    public function menuTabChange($index): void
    {
        $this->index = $index;
        $this->emitTo('hotels.managers.core-board',
            'CoreBoardMenuTabChange',
            ['menu' => $this->menus[$index]]
        );
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.hotels.managers.menu-tab');
    }
}
