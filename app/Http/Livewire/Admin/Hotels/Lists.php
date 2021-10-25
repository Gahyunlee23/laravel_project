<?php

namespace App\Http\Livewire\Admin\Hotels;

use App\Hotel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class Lists extends Component
{
    use WithPagination;

    public $currentPage;
    public $curator = 'N';

    public function mount()
    {
        $this->currentPage = 1;
        $this->pageResolver();
    }
    public function curatorChange($key)
    {
        $this->curator = $key;
        $this->render();
    }

    /* Paginate */
    protected function pageResolver(): void
    {
        session(['currentPage' => $this->currentPage]);
        Paginator::currentPageResolver(function(){
            return $this->currentPage;
        });
        $this->render();
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

    public function dataLoad()
    {
        return Hotel::with(['options' => function ($query) {
            $query->whereDisable('N');
            $query->orderBy('id');
        },
            'images' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            },
            'faqs' => function ($query) {
                $query->orderBy('id');
            },
            'rooms' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            },
            'checkPoints' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            }])->where('curator','=', $this->curator)
            ->orderByRaw('hotels.order is null asc')
            ->orderBy('order', 'ASC')
            ->orderBy('status', 'desc');
    }
	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
        $hotels = $this->dataLoad()->paginate(5);
		return view('livewire.admin.hotels.lists', [
		    'hotels'=>$hotels
        ]);
	}
}
