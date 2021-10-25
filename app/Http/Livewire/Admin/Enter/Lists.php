<?php

namespace App\Http\Livewire\Admin\Enter;

use App\AddHotel;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class Lists extends Component
{
    use WithPagination;
    /* Data */
    public $addHotels;
    public $currentPage;

    public $pageView=20;

    public function mount(){

    }

    public function dataLoad()
    {
       return AddHotel::whereNotNull('hotel_manager_id')->orderByDesc('id');
    }


    /* Paginate */
    protected function pageResolver(): void
    {
        session(['currentPage' => $this->currentPage]);
        Paginator::currentPageResolver(function(){
            return $this->currentPage;
        });
        $this->emitSelf('render');
    }
    public function resetPage(): void
    {
        $this->currentPage = 1;
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
        //Session::flash('message', '큐레이터 등록 완료!');
    }
    public function checkPage(): void
    {
        if($this->currentPage !== null){
            $this->pageResolver();
        }
    }

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
	    $addHotelList = $this->dataLoad()->paginate($this->pageView);
		return view('livewire.admin.enter.lists', [
		    'addHotelList' =>$addHotelList
        ]);
	}
}
