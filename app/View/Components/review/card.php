<?php

namespace App\View\Components\review;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class card extends Component
{
    public $profile,$name,$job,$explanation;

    /**
     * Create a new component instance.
     *
     * @param $profile
     * @param $name
     * @param $job
     * @param $explanation
     */
    public function __construct($profile,$name,$job,$explanation)
    {
        $this->profile=$profile;
        $this->name=Str::substr($name,0,1).'◯◯';
        $this->job=$job;
        $this->explanation=$explanation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.review.card');
    }
}
