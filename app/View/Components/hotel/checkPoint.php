<?php

namespace App\View\Components\hotel;

use Illuminate\View\Component;

class checkPoint extends Component
{
    public $image,$point,$title,$explanation,$containerClass,$containerStyle;

    /**
     * Create a new component instance.
     *
     * @param $image
     * @param $point
     * @param $title
     * @param $explanation
     * @param $containerClass
     * @param $containerStyle
     */
    public function __construct($image,$point,$title,$explanation,$containerClass,$containerStyle)
    {
        $this->image=$image;
        $this->point=$point;
        $this->title=$title;
        $this->explanation=$explanation;
        $this->containerClass=$containerClass;
        $this->containerStyle=$containerStyle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.hotel.check-point');
    }
}
