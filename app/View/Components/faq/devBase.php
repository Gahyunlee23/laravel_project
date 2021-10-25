<?php

namespace App\View\Components\faq;

use Illuminate\View\Component;

class devBase extends Component
{
    public $now,$questionTitle,$question,$answer,$answerName,$answerJob;

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
    public function __construct($now,$questionTitle,$question,$answer,$answerName='',$answerJob='')
    {

        $this->now=$now;
        $this->questionTitle=$questionTitle;
        $this->question=$question;
        $this->answer=$answer;
        $this->answerName=$answerName;
        $this->answerJob=$answerJob;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.faq.dev-base');
    }
}
