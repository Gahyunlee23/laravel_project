<?php

namespace App\View\Components\hotel;

use App\Hotel;
use Illuminate\View\Component;
use Illuminate\View\View;

class detail extends Component
{
    public $hotel;

    /**
     * Create a new component instance.
     *
     * @param $hotelId
     */
    public function __construct($hotelId)
    {
        $this->hotel = Hotel::with([
        'options'=>function($query){
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
            $query->orderBy('id');
        },
        'checkPoints'=>function($query){
            $query->whereDisable('N');
            $query->orderBy('id');
        }])->whereId($hotelId)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.hotel.detail');
    }
}
