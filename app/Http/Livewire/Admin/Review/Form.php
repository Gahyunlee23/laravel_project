<?php

namespace App\Http\Livewire\Admin\Review;

use App\HotelReview;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $hotel;
    public $reviews;

    public $review_order;
    public $review_name;
    public $review_option;
    public $review_star=5;
    public $review_content;
    public $review_link;
    public $review_input_completed_at;
    public $review_image;

    protected $listeners = [
        'adminReviewEventReviewDelete'
    ];

    public function mount(): void
    {
        $this->review_input_completed_at=now()->format('Y-m-d');
        $this->reLoad();
    }
    public function reLoad(): void
    {
        if($this->hotel){
            $this->reviews = $this->hotel->reviews;
        }
    }

    public function adminReviewEventReviewDelete(HotelReview $review): void
    {
        try {
            $review->delete();
        } catch (\Exception $e) {
            ddd($e);
        }
    }

    protected $rules = [
        'review_order' => 'required|numeric|min:0|max:1000',
        'review_name' => 'required|min:1|max:20',
        'review_star' => 'required',
        'review_option' => 'required',
        'review_link' => '',
        'review_content' => 'required',
        'review_input_completed_at' => '',
        'review_image' => 'image|max:1024',
    ];

    public function updatedPhoto()
    {
        $this->validate([
            'review_image' => 'image|max:1024',
        ]);
    }

    public function submit()
    {
        $validate = $this->validate();
        $file = $this->review_image->store('/reviews/images/' . $this->hotel->id,'s3');
        HotelReview::Create([
            'visible' => 1,
            'hotel_room_type_id' => 0,
            'hotel_id' => $this->hotel->id,
            'input_completed_at' => $validate['review_input_completed_at'],
            'name' => $validate['review_name'],
            'option' => $validate['review_option'],
            'star' => $validate['review_star'],
            'content' => $validate['review_content'],
            'images' => $file,
            'order' => $validate['review_order'],
        ]);
        $this->formReset();
        \Session::flash('message', "리뷰 저장 완료");
    }

    public function formReset(): void
    {
        $this->review_order='';
        $this->review_name='';
        $this->review_option='';
        $this->review_star=5;
        $this->review_content='';
        $this->review_link='';
        $this->review_input_completed_at=now()->format('Y-m-d');
        $this->review_image=null;
    }

    public function render()
    {
        return view('livewire.admin.review.form');
    }
}
