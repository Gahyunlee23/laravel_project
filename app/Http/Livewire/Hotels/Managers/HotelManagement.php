<?php

namespace App\Http\Livewire\Hotels\Managers;

use App\AddHotel;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class HotelManagement extends Component
{
    use WithPagination;

    /* Request */
    public $title;
    public $type;

    /* Data */

    /* Alpine */
    public $reason;
    public $sortField = 'updated_at';
    public $sortAsc = true;

    public $currentPage=1;
    public $paginate = 5;

    public function mount(){
        $this->resetPage();
    }

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    /* Paginate */
    protected function pageResolver(): void
    {
        Paginator::currentPageResolver(function(){
            return $this->currentPage;
        });
        $this->emitSelf('render');
    }
    public function resetPage(): void
    {
        $this->currentPage = 1;
        $this->pageResolver();
    }
    public function nextPage(): void
    {
        ++$this->currentPage;
        $this->pageResolver();
    }
    public function previousPage(): void
    {
        --$this->currentPage;
        $this->pageResolver();
    }
    public function gotoPage($page): void
    {
        $this->currentPage = $page;
        $this->pageResolver();
    }
    public function checkPage(): void
    {
        if($this->currentPage !== null){
            $this->pageResolver();
        }
    }
    public function dataLoad()
    {
        switch ($this->type){
            case '입점 승인' :
                return AddHotel::whereHotelManagerId(auth()->user()->id)->whereIn('enter_status', ['오픈 확정', '입점 승인'])->orderByDesc('id');
            case '입점 미승인' :
                return AddHotel::whereHotelManagerId(auth()->user()->id)->whereEnterStatus($this->type)->orderByDesc('id');
            default :
                return AddHotel::whereHotelManagerId(auth()->user()->id)->whereNotIn('enter_status', ['입점 승인', '입점 미승인', '오픈 확정'])->orderByDesc('id');
        }
    }

    public function seeReason(AddHotel $hotel)
    {
        if($hotel->reasons->count() >= 1){
            $this->reason = $hotel->reason;
        }
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
	    $hotels = $this->dataLoad()->paginate($this->paginate);

		return view('livewire.hotels.managers.hotel-management',[
		    'hotels'=>$hotels
        ]);
	}
}
