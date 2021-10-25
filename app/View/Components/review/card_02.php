<?php

namespace App\View\Components\review;

use App\HotelReview;
use App\HotelRoomType;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class card_02 extends Component
{
    public $name,$option,$content,$date;

    /**
     * Create a new component instance.
     *
     * @param HotelReview $review
     */
    public function __construct(HotelReview $review)
    {
        $this->name=Str::substr($review->name,0,1).'<span class="tracking-widest">◯◯</span>';
        $this->option=$review->option;
        $this->date=Carbon::parse($review->input_completed_at)->format('Y. m. d');
        $this->content=$review->content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.review.card_02');
    }
}
