<?php

namespace App\View\Components\faq;

use Illuminate\View\Component;

class base extends Component
{
    public $now,$questionTitle,$question,$answer,$answerName,$answerJob,$hotelId;

    /**
     * Create a new component instance.
     *
     * @param $now
     * @param $questionTitle
     * @param $question
     * @param $answer
     * @param string $answerName
     * @param string $answerJob
     */
    public function __construct($now,$questionTitle,$question,$answer,$answerName='',$answerJob='',$hotelId='')
    {
        $this->now=$now;
        $this->questionTitle=$questionTitle;
        $this->question=$question;
        $this->answer=$answer;
        $this->answerName=$answerName;
        $this->answerJob=$answerJob;
        $this->hotelId=$hotelId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.faq.base');
    }
}
