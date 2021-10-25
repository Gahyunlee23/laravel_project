<?php

namespace App\View\Components\hotel;

use App\Hotel;
use Illuminate\View\Component;

class lists extends Component
{
    public $hotels,$hotelId,$curatorId,$progress=1;

    /**
     * Create a new component instance.
     *
     * @param string $hotelId
     * @param bool $curatorId
     */
    public function __construct($hotelId='',$curatorId=false)
    {
        $this->hotelId=$hotelId;
        $this->curatorId=$curatorId;

        if($hotelId ===''){
            $hotels=Hotel::with(['options'=>function($query){
                $query->whereDisable('N');
                $query->orderBy('id');
            },
            'images'=>function($query){
                $query->whereDisable('N');
                $query->orderBy('id');
            },
            'faqs'=>function($query){
                $query->orderBy('id');
            },
            'rooms'=>function($query){
                $query->whereDisable('N');
                $query->whereVisible('1');
                $query->orderBy('order')->orderBy('id');
            },
            'checkPoints'=>function($query){
                $query->whereDisable('N');
                $query->orderBy('id');
            }])->orderByRaw('hotels.order is null asc')->orderBy('order','ASC')->whereStatus('2')->get();
            $this->progress=1;
        }else{
            $hotels=Hotel::with(['options'=>function($query){
                $query->whereDisable('N');
                $query->orderBy('id');
            },
            'images'=>function($query){
                $query->whereDisable('N');
                $query->orderBy('id');
            },
            'faqs'=>function($query){
                $query->orderBy('id');
            },
            'rooms'=>function($query){
                $query->whereDisable('N');
                $query->whereVisible('1');
                $query->orderBy('order')->orderBy('id');
            },
            'checkPoints'=>function($query){
                $query->whereDisable('N');
                $query->orderBy('id');
            }])->whereId($hotelId)->whereStatus('2')->get();
            $this->progress=2;
        }
        $this->hotels = $hotels;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.hotel.lists');
    }
}
