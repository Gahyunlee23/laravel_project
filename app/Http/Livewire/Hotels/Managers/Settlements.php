<?php

namespace App\Http\Livewire\Hotels\Managers;

use App\HotelReservation;
use App\Settlement;
use Livewire\Component;
use Livewire\WithPagination;

class Settlements extends Component
{
    use WithPagination;

    /* Request */
    public $hotelTab;

    /* Response */
    public $currentPage;
    public $search = '';
    public $order_names = '';

    /* Data */
    public $detail_settlement;

    /* Alpine */
    public $sortField = 'updated_at';
    public $sortAsc = true;

    public $status = '전체';

    protected $listeners = [
        'hotelReload'
    ];

    public function mount()
    {

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
    public function hotelReload($index): void
    {
        $this->hotelTab = $index;
        $this->render();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->getOrderNames();
    }

    public function getOrderNames(): void
    {
        $this->reset('order_names');
        if ($this->search !== '' && $this->search !== null) {
            $this->order_names = $this->dataLoad()->get()->groupBy('reservation.order_name')->keys();
        }
    }

    public function searchExampleClick($index): void
    {
        $this->search = $this->order_names[$index];
        $this->reset('order_names');
    }

    public function dataLoad()
    {
        return Settlement::where(function ($q) {
            if($this->status === '전체'){
                $q->orWhere('settlements.mail_send_dt', '!=', null)
                    ->orWhere('settlements.calculate_yn', '=', 'Y');
            }elseif($this->status === '정산 완료'){
                $q->where('settlements.calculate_yn', '=', 'Y');
            }elseif($this->status === '정산 예정'){
                $q->where('settlements.mail_send_dt', '!=', null)
                ->where('settlements.calculate_yn', '=', 'N');
            }
        })->whereHas('payment', function ($q) {
            $q->whereHas('reservation', function ($q) {
                $q->where('hotel_id', '=', auth()->user()->HotelManagers->get($this->hotelTab)->hotel->id)
                    ->whereIn('order_status', ['3', '4', '5', '6', '10', '11']);
                if($this->search!=='' && $this->search!==null){
                    $q->where('order_name', 'like', '%' . $this->search . '%');
                }
            })->whereIn('status', ['3', '5', '10', '11']);
        });
    }

    public function settlementsStatus($status): void
    {
        switch ($status){
            case '1' :
                $this->status = '전체';
            break;
            case '2' :
                $this->status = '정산 완료';
            break;
            case '3' :
                $this->status = '정산 예정';
            break;
        }
        $this->resetPage();
    }

    public function openDetailModal($settlement_id): void
    {
        $this->detail_settlement = Settlement::find($settlement_id);
        $this->gotoPage($this->currentPage);
    }
    public function render()
    {
        $settlements = $this->dataLoad();
        return view('livewire.hotels.managers.settlements', [
            'settlements' => $settlements->paginate(10)
        ]);
    }
}
