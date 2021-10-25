<?php

namespace App\Http\Livewire\Customer;

use App\AlertTalkList;
use App\Notice;
use Livewire\Component;

class AlertLists extends Component
{
    public $readyToLoad = false;
    public $lists;
    public $notices;
    public $type;
    protected $listeners = ['viewAlertListsEvent' => 'loadLists'];

    public function loadLists(): void
    {
        $this->readyToLoad = true;

        $this->dispatchBrowserEvent('https-url-state-change',['tab'=>'alert-lists']);
    }
    public function render()
    {
        $this->notices = $this->readyToLoad ? Notice::where(function($query){
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
        })->orderBy('send_dt', 'DESC')->get() : [];

        switch ($this->type){
            case 'unread' :
                $this->lists = $this->readyToLoad ? auth()->user()->alert_lists->where('read_at', '=', null)->where('catalog', '!=', '주문 이탈') : null;
                break;
            case 'all' :
            default :
                $this->lists = $this->readyToLoad ? auth()->user()->alert_lists->where('catalog', '!=', '주문 이탈') : null;
            break;
        }
        return view('livewire.customer.alert-lists');
    }

    public function read($type,$id,$model='AlertTalkList')
    {
        if($model === 'AlertTalkList'){
            if($type === 'read'){
                AlertTalkList::where('id','=',$id)->update(['read_at'=>now()]);
            }
            if($type === 'cancel'){
                AlertTalkList::where('id','=',$id)->update(['read_at'=>null]);
            }
        }elseif($model === 'notices'){
            if($type === 'read'){
                Notice::where('id','=',$id)->update(['read_dt'=>now()]);
            }
            if($type === 'cancel'){
                Notice::where('id','=',$id)->update(['read_dt'=>null]);
            }
        }
        $this->emit('listCountReCountEvent');
    }
}
