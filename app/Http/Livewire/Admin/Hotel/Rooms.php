<?php

namespace App\Http\Livewire\Admin\Hotel;

use App\HotelRoom;
use Illuminate\Pagination\Paginator;
use Livewire\Component;

class Rooms extends Component
{
    /* Request */
    public $hotel;

    /* Response */
    public $roomFind;

    /* Input */
    public $title, $name, $nights, $days, $order;
    public $price, $sale_price, $discount_rate, $refund_amount, $coupon;
    public $main_explanation, $explanation, $sub_explanation,$memo;

    /* Alpine */
    public $disable_type = 'Y';
    public $all_count;
    public $visible_count;
    public $form_show = false;
    public $currentPage;

    public function mount()
    {
        $this->counter();
    }

    public function counter(): void
    {
        $this->all_count = HotelRoom::whereHotelId($this->hotel->id)
            ->where('visible', '=', '1')
            ->count();
        $this->visible_count = HotelRoom::whereHotelId($this->hotel->id)
            ->where('visible', '=', '1')
            ->where('disable', '=', 'N')
            ->count();
    }
    public function dataLoad()
    {
        if ($this->hotel) {
            return HotelRoom::whereHotelId($this->hotel->id)
                ->orderBy('disable')
                ->orderBy('visible', 'DESC')
                ->orderBy('order')
                ->where('visible', '=', '1')
                ->where(function ($query) {
                    if ($this->disable_type !== 'all') {
                        $query->where('disable', '=', 'N');
                    }
                });
        }
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'name' => 'required',
            'price' => 'required|integer',
            'sale_price' => 'required|integer',
            'discount_rate' => '',
            'refund_amount' => '',
            'main_explanation' => 'required',
            'explanation' => '',
            'sub_explanation' => '',
            'order' => 'required|integer',
            'nights' => 'required',
            'days' => 'required',
            'coupon' => '',
            'memo' => '',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => '옵션명 은(는) 필수 입니다',
            'name.required' => '룸타입 은(는) 필수 입니다',
            'price.required' => '원가 은(는) 필수 입니다',
            'price.integer' => '원가 은(는) 숫자 값 입니다',
            'sale_price.required' => '판매가 은(는) 필수 입니다',
            'sale_price.integer' => '판매가 은(는) 숫자 값 입니다',
            'main_explanation.required' => '메인 설명 은(는) 필수 입니다',
            'order.required' => '출력순 은(는) 필수 입니다',
            'order.integer' => '출력순 은(는) 숫자 값 입니다',
            'nights.required' => '박수 은(는) 필수 입니다',
            'days.required' => '일수 은(는) 필수 입니다',
        ];
    }

    public function disableType($type)
    {
        $this->disable_type = $type;
        //$this->dataLoad();
    }

    public function roomDisableById($id, $yn): void
    {
        try {
            $room = HotelRoom::find($id);
            if ($room) {
                $room->disable = $yn;
                $room->save();
            }
        } catch (\Exception $e) {
            ddd('삭제 오류 개발자 문의');
        }
        //$this->dataLoad();
    }

    public function roomSoftDeleteById($id): void
    {
        try {
            HotelRoom::find($id)->delete();
        } catch (\Exception $e) {
            ddd('삭제 오류 개발자 문의');
        }
        //$this->dataLoad();
    }

    public function roomNotVisibleById($id): void
    {
        try {
            $room = HotelRoom::find($id);
            if ($room) {
                $room->visible = '0';
                $room->save();
            }
        } catch (\Exception $e) {
            ddd('roomNotVisibleById 처리 오류 개발자 문의');
        }
        //$this->dataLoad();
    }

    public function roomVisibleById($id): void
    {
        try {
            $room = HotelRoom::find($id);
            if ($room) {
                $room->visible = '1';
                $room->save();
            }
        } catch (\Exception $e) {
            ddd('roomVisibleById 처리 오류 개발자 문의');
        }
        //$this->dataLoad();
    }

    public function roomUpdate($roomId): void
    {
        $this->form_show = true;
        $this->preview_image = false;
        $room = HotelRoom::find($roomId);
        if ($room) {
            $this->roomFind = $room;
            $this->title = $room->title;
            $this->name = $room->name;
            $this->price = $room->price;
            $this->sale_price = $room->sale_price;
            $this->discount_rate = $room->discount_rate;
            $this->refund_amount = $room->refund_amount;
            $this->main_explanation = $room->main_explanation;
            $this->explanation = $room->explanation;
            $this->sub_explanation = $room->sub_explanation;
            $this->order = $room->order;
            $this->nights = $room->nights;
            $this->days = $room->days;
            $this->coupon = $room->coupon;
            $this->memo = $room->memo;
        }
    }

    public function RoomSubmit()
    {
        $validate = collect($this->validate($this->rules()));
        HotelRoom::create([
            'hotel_id' => $this->hotel->id,
            'user_id' => auth()->user()->id,
            'title' => $validate->get('title'),
            'name' => $validate->get('name'),
            'price' => $validate->get('price'),
            'sale_price' => $validate->get('sale_price'),
            'discount_rate' => $validate->get('discount_rate'),
            'refund_amount' => $validate->get('refund_amount'),
            'main_explanation' => $validate->get('main_explanation'),
            'explanation' => $validate->get('explanation'),
            'sub_explanation' => $validate->get('sub_explanation'),
            'order' => $validate->get('order'),
            'nights' => $validate->get('nights'),
            'days' => $validate->get('days'),
            'coupon' => $validate->get('coupon'),
            'memo' => $validate->get('memo'),
            'visible' => 1,
            'disable' => 'Y',
        ]);

        \Session::flash('message', "룸 타입 저장 완료");
        $this->formReset();
        //$this->dataLoad();
    }

    public function RoomUpdateSubmit()
    {
        $validate = collect($this->validate($this->rules()));
        if($this->roomFind){
            $this->roomFind->update([
                'user_id' => auth()->user()->id,
                'title' => $validate->get('title'),
                'name' => $validate->get('name'),
                'price' => $validate->get('price'),
                'sale_price' => $validate->get('sale_price'),
                'discount_rate' => $validate->get('discount_rate'),
                'refund_amount' => $validate->get('refund_amount'),
                'main_explanation' => $validate->get('main_explanation'),
                'explanation' => $validate->get('explanation'),
                'sub_explanation' => $validate->get('sub_explanation'),
                'order' => $validate->get('order'),
                'nights' => $validate->get('nights'),
                'days' => $validate->get('days'),
                'coupon' => $validate->get('coupon'),
                'memo' => $validate->get('memo'),
            ]);
        }
        \Session::flash('message', "룸 타입 수정 완료");
        $this->formReset();
        //$this->dataLoad();
    }


    public function formReset(): void
    {
        $this->form_show= false;
        $this->roomFind= null;
        $this->reset([
            'order', 'name', 'title', 'nights', 'days', 'coupon',
            'price', 'sale_price', 'discount_rate', 'refund_amount',
            'main_explanation', 'explanation', 'sub_explanation'
        ]);
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
        if($propertyName === 'sale_price' || $propertyName === 'price' ){
            $this->discount_rate = floor(($this->price-$this->sale_price) / $this->price * 100);
        }
    }


    /* Paginate */
    protected function pageResolver(): void
    {
        session(['currentPage' => $this->currentPage]);
        Paginator::currentPageResolver(function(){
            return $this->currentPage;
        });
        $this->emitSelf('render');
    }
    public function resetPage(): void
    {
        $this->currentPage = 1;
    }
    public function nextPage(): void
    {
        ++$this->currentPage;
        $this->pageResolver();
    }
    public function previousPage(): void
    {
        --$this->currentPage;
        $this->pageResolver();
    }
    public function gotoPage($page): void
    {
        $this->currentPage = $page;
        $this->pageResolver();
        //Session::flash('message', '큐레이터 등록 완료!');
    }
    public function checkPage(): void
    {
        if($this->currentPage !== null){
            $this->pageResolver();
        }
    }

    public function render()
    {
        $rooms=$this->dataLoad()->paginate(10);
        return view('livewire.admin.hotel.rooms', [
            'rooms'=>$rooms
        ]);
    }
}
