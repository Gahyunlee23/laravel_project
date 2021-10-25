<?php

namespace App\Http\Livewire\Hotels;

use App\HotelOption;
use App\Models\CollectSearch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Component;

class Collect extends Component
{
    /*public $search;*/
    public $tabSearch;
    public $depthSearch;
    public $curator;
    public $tabs = ['전체', '서울', '경기ㆍ인천', '부산'];
    public $titleEN = ['Living in Hotel', 'seoul', 'GyeonggiㆍIncheon','busan'];
    public $explanation = ['공간의 변화, 설렘의 시작', '복잡한 도심, 여유로운 쉼터', '편리한 일상, 여유의 시작','반짝이는 바다, 눈부신 모래사장'];
    public $tab = '전체';
    public $tabImage;
    public $tabIndex=0;
    public $depth = '';
    public $depths;
    public $list;
    public $searchBar;


    protected $listeners = ['tabChange','depthChange'];

    public function mount(): void
    {
        if($this->tabSearch){
            if(in_array($this->tabSearch, $this->titleEN, true)){
                $this->tabIndex=array_search($this->tabSearch, $this->titleEN, true);
                $this->tab = $this->tabs[array_search($this->tabSearch, $this->titleEN, true)];
            }
        }
        $this->getList();
        if($this->depthSearch){
            if(in_array($this->depthSearch, $this->getDepthList(), true)){
                $this->depth = $this->depths[array_search($this->depthSearch, $this->getDepthList(), true)];
                $this->getList($this->depth);
            }
        }else{
            $this->depth=$this->depths[0] ?? '';
        }
        $this->tabImage=$this->getTabImage();
    }

    public function tabChange($tab): void
    {
        $this->tab=$tab;
        $this->tabIndex = array_search($tab, $this->tabs, true);
        $this->getList();
        $this->tabImage=$this->getTabImage();
        $this->depth=$this->depths[0] ?? '';
        $this->backgroundImageLoad();

        $this->dispatchBrowserEvent('https-url-state-change',['tab'=>$this->titleEN[$this->tabIndex],'curator'=>$this->curator->user_page ?? null]);
    }

    public function depthChange($depth): void
    {
        $this->depth=$depth;
        $this->getList($depth);
        $this->backgroundImageLoad();
        $this->dispatchBrowserEvent('https-url-state-change',['tab'=>$this->titleEN[$this->tabIndex],'depth'=>$this->depth,'curator'=>$this->curator->user_page ?? null]);
    }

    public function collectSwiperReInit(): void
    {
        $this->dispatchBrowserEvent('collect-swiper-re-init');
    }

    public function backgroundImageLoad(): void
    {
        $this->dispatchBrowserEvent('imagesLoad');
    }

    public function updatedSearchBar()
    {
        $this->getList();
        $this->backgroundImageLoad();
    }

    public function getList($depth=null): void
    {
        $list=HotelOption::join('hotels', 'hotels.id', '=', 'hotel_options.hotel_id')
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
            })->where('disable', '=', 'N')
            ->where(function($q){
                if($this->tab === '전체') {
                    if($this->searchBar!=='' && $this->searchBar !==null) {
                        $q->where('title', 'like', '%' . $this->searchBar . '%');
                        CollectSearch::create([
                            'user_id' => auth()->user()->id ?? null,
                            'search' => $this->searchBar
                        ]);
                    }
                } else {
                    if(Str::of($this->tab)->contains('ㆍ')){
                        foreach (Str::of($this->tab)->explode('ㆍ') as $index => $item){
                            $q->orWhere('area', 'like', '%'.$item.'%');
                        }
                    }else{
                        $q->where('area', 'like', '%'.$this->tab.'%');
                    }
                }

            })->groupBy('hotels.id');

        if($depth && $depth!=='전체보기'){
            $list->where('area','like','%'.$depth.'%');
        }
        $this->list=$list->get();

        $this->depths = $this->getDepthList();
    }

    public function getTabImage()
    {
        switch ($this->tab) {
            case '전체':
                return '/collect/img-all.png';
            case '서울':
                return '/collect/img-seoul.png';
            case '경기ㆍ인천':
                return '/collect/img-gyeonggiincheon.png';
            case '부산':
                return '/collect/img-busan.png';
        }
        return null;
    }
    public function getDepthList(): ?array
    {
        switch ($this->tab) {
            case '서울':
                return ['전체보기','강남구','구로구','마포구','서초구','송파구','영등포구','용산구','중구'];
        }
        return [];
    }

    public function render()
    {
        return view('livewire.hotels.collect');
    }
}
