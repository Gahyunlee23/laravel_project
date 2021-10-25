<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Banner;
use App\Curator;
use App\CuratorHotel;
use App\Hotel;
use Carbon\Carbon;
use Livewire\Component;

class Form extends Component {
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
   // livewire view에서 wire:model="something"의 값을 넣어줄 것들 정리

    public $title;
    public $explanation;
    public $event;
    public $order;
    public $memo;
    public $startdt;
    public $enddt;
    public $hotel;

    public $hotels;
    public $curatorCheck;

    public $bannerId;
    public $banner;
    public $view;
    public $route;
    public $curators;
    public $curator;
    public $tab;
    public $depth;
    public $depthList = ['전체보기','강남구','마포구','서초구','영등포구','용산구','중구'];



    public function updatedView($value)
    {
        if($value === 'main'){
            $this->hotels = Hotel::whereCurator('N')->get();
        }
        if($value === 'curator'){
            $this->hotels = Hotel::whereCurator('Y')->get();
        }
    }

    public function updatedHotel($value)
    {
        if($value!=='' && $value!==null){
            $this->curators = Curator::whereIn('id',
                CuratorHotel::whereHotelId($value)->groupBy('curator_id')->pluck('curator_id')
            )->get();
        }
    }

    public function updatedCurator($value) {
        return $this->curator;
    }


    //view page 처음에 랜딩할때 initialize 시켜줄 기본 값 설정
    public function mount() {
        //$this->curators = Curator::get();
        //$this->hotels = Hotel::get();

        if($this->bannerId !== null){
            $this->banner = Banner::find($this->bannerId);
            $this->view = $this->banner->view;
            $this->route = $this->banner->route;
            $this->title = $this->banner->title;
            $this->explanation = $this->banner->explanation;
            $this->event = $this->banner->event;
            $this->order = $this->banner->order;
            $this->memo = $this->banner->memo;
            $this->startdt = $this->banner->start_dt;
            $this->enddt = $this->banner->end_dt;
        }
    }

    public function submitBanner()
    {
        if($this->bannerId) {
            Banner::where('id', $this->bannerId)->update([
                'title' => $this->title,
                'explanation' =>$this->explanation,
                'event' => $this->event,
                'view' => $this->view,
                'order' => $this->order,
                'curator_id' => NULL,
                'route' => $this->route,
                'tab' => $this->tab,
                'depth' => $this->depth,
                'start_dt' => Carbon::parse($this->startdt)->format('Y-m-d H:i:s'),
                'end_dt' => Carbon::parse($this->enddt)->format('Y-m-d H:i:s')
            ]);
            session()->flash('message', '배너 수정 완료');
            return redirect()->route('admin.banner');
        }


        if($this->view === 'curator') {
            if($this->curatorCheck === 'all') {
                Banner::create([
                    'title' => $this->title,
                    'explanation' =>$this->explanation,
                    'event' => $this->event,
                    'view' => $this->view,
                    'order' => $this->order,
                    'curator_id' => NULL,
                    'route' => $this->route,
                    'tab' => $this->tab,
                    'depth' => $this->depth,
                    'start_dt' => Carbon::parse($this->startdt)->format('Y-m-d H:i:s'),
                    'end_dt' => Carbon::parse($this->enddt)->format('Y-m-d H:i:s')
                ]);

                session()->flash('message', '큐레이터 전체 배너 저장 완료');
                return redirect()->route('admin.banner');

            } else {
                if(isset($this->curator)) {
                    foreach ($this->curator as $item){
                        Banner::create([
                            'curator_id' => $item,
                            'title' => $this->title,
                            'explanation' =>$this->explanation,
                            'event' => $this->event,
                            'view' => $this->view,
                            'order' => $this->order,
                            'curator' => $this->curator,
                            'route' => $this->route,
                            'tab' => $this->tab,
                            'depth' => $this->depth,
                            'start_dt' => Carbon::parse($this->startdt)->format('Y-m-d H:i:s'),
                            'end_dt' => Carbon::parse($this->enddt)->format('Y-m-d H:i:s')
                        ]);
                    }
                }
            }
            session()->flash('message', '큐레이터 개별 배너 저장 완료');
            return redirect()->route('admin.banner');
        }



        if($this->view === 'main'){
            Banner::create([
                'title' => $this->title,
                'explanation' =>$this->explanation,
                'event' => $this->event,
                'view' => $this->view,
                'order' => $this->order,
                'curator' => $this->curator,
                'route' => $this->route,
                'tab' => $this->tab,
                'depth' => $this->depth,
                'start_dt' => Carbon::parse($this->startdt)->format('Y-m-d H:i:s'),
                'end_dt' => Carbon::parse($this->enddt)->format('Y-m-d H:i:s')
            ]);

            session()->flash('message', '메인 뷰 배너 저장 완료');
            return redirect()->route('admin.banner');
        }
    }

    public function render() {
        return view('livewire.admin.banner.form');
    }
}
