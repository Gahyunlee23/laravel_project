<?php

namespace App\Http\Livewire\Hotels;

use App\HotelOption;
use Illuminate\Support\Str;
use Livewire\Component;
use Carbon\Carbon;


class Catalog extends Component
{
    public $load=false;
    public $tabSearch;

    public $curator;
    public $tabs = ['서울', '경기ㆍ인천', '부산'];
    public $titleEN = ['seoul', 'GyeonggiㆍIncheon','busan'];
    public $explanation = ['복잡한 도심, 여유로운 쉼터', '편리한 일상, 여유의 시작','반짝이는 바다, 눈부신 모래사장'];

    public $tab = '서울';
    public $tabImage;
    public $tabIndex=0;
    public $itemIndex=0;

    public $remainingTime;

    public $list;


    protected $listeners = ['tabChange','itemChange'];

    public function catalogLoad()
    {
        $this->load = true;
        $this->getList();
        $this->catalogSwiperReInit();
    }

    public function mount(): void
    {
        if($this->tabSearch){
            if(in_array($this->tabSearch, $this->titleEN, true)){
                $this->tabIndex=array_search($this->tabSearch, $this->titleEN, true) ?? 0;
                $this->tab = $this->tabs[array_search($this->tabSearch, $this->titleEN, true)];
            }
        }
        $this->getList();
    }

    public function tabChange($tab): void
    {
        if($tab!==$this->tab){
            $this->tab=$tab;
            $this->tabIndex = array_search($tab, $this->tabs, true);

        }
        $this->itemIndex=0;

        $this->getList();
        $this->catalogSwiperReInit();
    }
    public function itemChange($index): void
    {
        if($this->itemIndex!==$index){
            $this->itemIndex=$index;
        }
        $this->getList();
        $this->catalogSwiperReInit();
    }



    public function catalogSwiperReInit(): void
    {
        $this->dispatchBrowserEvent('catalog-swiper-re-init');
    }

    public function getList(): void
    {
        $list=HotelOption::Join('hotels', 'hotels.id', '=', 'hotel_options.hotel_id')
            ->orderByRaw('hotels.order is null asc')->orderBy('hotels.order', 'ASC')
            ->where(function ($query){
                if(auth()->check() && auth()->user()->hasAnyRole('개발','super-admin','admin')){
                    $query->whereIn('hotels.status', ['1','2']);
                }else{
                    $query->where('hotels.status','=','2');
                }
            })->where(function ($query){
                if($this->curator && $this->curator->curatorHotels->count() >= 1){
                    $query->where(function($query) {
                        $query->where('hotels.curator','=','Y')
                            ->whereIn('hotels.id', $this->curator->curatorHotels->pluck('hotel_id'));
                    });
                }else{
                    $query->where('hotels.curator','=','N');
                }
            })
            ->where('disable', '=', 'N')
            ->where(function($q){
                if(Str::of($this->tab)->contains('ㆍ')){
                    foreach (Str::of($this->tab)->explode('ㆍ') as $index => $item){
                        $q->orWhere('area', 'like', '%'.$item.'%');
                    }
                }else{
                    $q->where('area', 'like', '%'.$this->tab.'%');
                }
            })->groupBy('hotels.id')->limit(10);
        $this->list=$list->get();

    }

    public function render()
    {
        return view('livewire.hotels.catalog');
    }
}
