<?php

namespace App\Http\Livewire\Customer;

use App\Notice;
use Livewire\Component;

class ListCount extends Component
{
    public $type;
    public $count;
    public $notices;

    public $link;

    protected $listeners = [
        'listCountReCountEvent' => 'reCount'
    ];
    public function mount(){
        $this->getCount();
    }

    public function reCount(){
        $this->getCount();
        $this->render();
    }

    public function getCount(){
        $this->notices = Notice::where(function($query){
            $query->where(function ($q){
                $q->where('user_id', '=', auth()->user()->id);
            })->orwhere(function ($q){
                $q->whereIn('hotel_id', auth()->user()->reservations->pluck('hotel_id')->toArray())
                    ->whereNull('reservation_type');
            })->orwhere(function ($q){
                /* 고객의 주문[type] 배열로 foreach 처리 + hotel_id, reservation_type 을 orwhere 로 각 공지사항 별로 확인함
                  hotel_id:reservation_type 이 공지사항과 동일해야됨*/
                foreach (auth()->user()->reservations->pluck('type') as $index => $item) {
                    $q->orwhere(function($q) use ($item,$index){
                        $q->where('hotel_id', '=', auth()->user()->reservations->pluck('hotel_id')->toArray()[$index])
                            ->where('reservation_type', '=',$item);
                    });
                }
            });
        })->get();

        switch ($this->type){
            case 'alert_lists' :
                $this->count = auth()->user()->alert_lists->where('read_at','=',null)->count()
                    + $this->notices->where('read_dt','=',null)->count();
            break;

            case 'tour_lists' :
                $this->count = auth()->user()->tour_lists->where('read_at','=',null)->count();
            break;

            case 'month_lists' :
                $this->count = auth()->user()->month_lists->where('read_at','=',null)->count();
            break;

            case 'all_lists' :
                $this->count = auth()->user()->alert_lists->where('read_at','=',null)->count()
                    + $this->notices->where('read_dt','=',null)->count()
                    + auth()->user()->tour_lists->where('read_at','=',null)->count()
                    + auth()->user()->month_lists->where('read_at','=',null)->count();

                $maxCount = collect([
                    auth()->user()->alert_lists->where('read_at','=',null)->count() + $this->notices->where('read_dt','=',null)->count(),
                    auth()->user()->tour_lists->where('read_at','=',null)->count(),
                    auth()->user()->month_lists->where('read_at','=',null)->count()
                ]);
                switch ($maxCount->search($maxCount->max())){
                    case '0' :
                        $this->link = route('my-page.main', ['tab'=>'alert-lists']);
                    break;
                    case '1' :
                        $this->link = route('my-page.main', ['tab'=>'tour-lists']);
                    break;
                    case '2' :
                        $this->link = route('my-page.main', ['tab'=>'month-lists']);
                    break;
                }
            break;
        }
    }

    public function render()
    {
        return view('livewire.customer.list-count');
    }
}
