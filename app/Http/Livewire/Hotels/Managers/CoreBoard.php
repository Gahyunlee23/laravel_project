<?php

namespace App\Http\Livewire\Hotels\Managers;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CoreBoard extends Component
{

    /* Request */
    public $user;

    /* Response */

    /* Data */
    public $test = 0;

    /* Alpine */
    public $hotelTab;
    public $menus = ['주문 리스트', '정산 리스트'];
    public $menu;
    public $menuIndex=0;

    public $list;

    protected $listeners = [
        'CoreBoardTabChange' => 'tabChange',
        'CoreBoardMenuTabChange' => 'menuTabChange',
        'getHotelTab'
    ];

    public function mount(){
        if(auth()->check()){
            $this->user = auth()->user();
        }
        $this->menu = $this->menus[0];
    }

    public function tabChange($data): void
    {
        $this->menu = $this->menus[0];
        $this->hotelTab = $data['tab'];
        $this->menuIndex = collect($this->menus)->search($this->menu);
        $this->setHttpsUrlStateChange();

        if($this->menuIndex === 0){
            $this->emitTo('hotels.managers.all-list', 'hotelReload', $this->hotelTab);
            $this->emitTo('hotels.managers.all-list', 'ListEventResetFlitterDate');
        }elseif($this->menuIndex === 1){
            $this->emitTo('hotels.managers.settlements', 'hotelReload', $this->hotelTab);
        }
    }

    public function menuTabChange($data): void
    {
        $this->menu = $data['menu'];

        $this->menuIndex = collect($this->menus)->search($this->menu);
        if($this->menuIndex === 0){
            $this->emitTo('hotels.managers.all-list', 'hotelReloadData', $this->hotelTab);
            $this->emitTo('hotels.managers.all-list', 'ListEventResetFlitterDate');
        }elseif($this->menuIndex===1){
            $this->emitTo('hotels.managers.settlements', 'hotelReload', $this->hotelTab);
        }
    }

    public function listChange($list): void
    {
        $this->list = $list;
        $this->setHttpsUrlStateChange();
        $this->emitTo('hotels.managers.all-list', 'hotelReloadList',$this->list);
        $this->emitTo('hotels.managers.all-list', 'ListEventFlitterReset');
        $this->emitTo('hotels.managers.all-list', 'ListEventResetFlitterDate');
    }

    public function setHttpsUrlStateChange(): void
    {
        $this->dispatchBrowserEvent('https-url-state-change', ['tab' => $this->hotelTab, 'list'=>$this->list]);
    }
    /**
     * @return mixed
     */
    public function getHotelTab()
    {
        return $this->hotelTab;
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.hotels.managers.core-board');
    }
}
