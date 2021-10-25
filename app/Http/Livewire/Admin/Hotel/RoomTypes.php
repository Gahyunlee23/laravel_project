<?php

namespace App\Http\Livewire\Admin\Hotel;

use App\HotelRoomType;
use App\RoomTypeImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class RoomTypes extends Component
{
    use WithFileUploads;

    /* Request */
    public $hotel;

    /* Response */
    public $room_types;
    public $all_count;
    public $visible_count;
    public $roomType;

    public $image_limit = 2;

    /* Input */
    public $hotel_id, $name, $order;
    public $visible, $upgrade = 'N', $sold_out = 0, $sale_possibility_count;
    public $image, $main_explanation, $sub_explanation;
    public $images;

    /* Alpine */
    public $visible_type = '1';
    public $form_show = false;
    public $preview_image = true;

    public function mount()
    {
        $this->reLoad();
        $this->counter();
    }

    public function counter(): void
    {
        $this->all_count = HotelRoomType::whereHotelId($this->hotel->id)
            ->count();
        $this->visible_count = HotelRoomType::whereHotelId($this->hotel->id)
            ->where('visible', '=', '1')
            ->count();
    }

    public function reLoad(): void
    {
        if ($this->hotel) {
            $this->room_types = HotelRoomType::whereHotelId($this->hotel->id)
                ->orderBy('visible', 'DESC')
                ->orderBy('id', 'DESC')
                ->orderBy('order')
                ->where(function ($query) {
                    if ($this->visible_type === '1') {
                        $query->where('visible', '=', '1');
                    }
                })
                ->get();
        }
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'main_explanation' => 'required',
            'sub_explanation' => 'required',
            'order' => 'required|integer',
            'image' => 'image|max:1024|mimes:png,jpg,jpeg',
            'sold_out' => 'required',
            'upgrade' => 'required',
            'sale_possibility_count' => 'integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '룸타입 은(는) 필수 입니다',
            'order.required' => '출력순 은(는) 필수 입니다',
            'order.integer' => '출력순 은(는) 숫자 값 입니다',
            'main_explanation.required' => '메인 설명 은(는) 필수 입니다',
            'sub_explanation.required' => '서브 설명 은(는) 필수 입니다',
            'image.image' => '이미지 은(는) 이미지 파일만 가능 합니다',
            'image.max' => '이미지 은(는) 1024KB 이하 입니다',
            'image.mimes' => '이미지 은(는) png, jpg, jpeg 입니다',
            'sold_out.required' => '매진 체크 은(는) 필수 입니다',
            'upgrade.required' => 'Upgrade 은(는) 필수 입니다',
            'sale_possibility_count.integer' => '판매 가능수 은(는) 숫자 값 입니다',
        ];
    }

    public function updatedImage(): void
    {
        $this->preview_image=true;
        $this->validate([
            'image' => 'image|max:1024|mimes:png,jpg',
        ]);
    }


    public function roomTypeUpdate($roomTypeId): void
    {
        $this->form_show=true;
        $this->preview_image = false;
        $roomType = HotelRoomType::find($roomTypeId);
        if($roomType) {
            $this->roomType=$roomType;
            $this->order = $this->roomType->order;
            $this->name = $this->roomType->name;
            $this->main_explanation = $this->roomType->main_explanation;
            $this->sub_explanation = $this->roomType->sub_explanation;
            $this->image = $this->roomType->image;
            $this->sold_out = $this->roomType->sold_out;
            $this->upgrade = $this->roomType->upgrade;
            $this->sale_possibility_count = $this->roomType->sale_possibility_count;
        }
        foreach (RoomTypeImage::whereHotelId($this->hotel->id)->whereRoomTypeId($roomType->id)->orderBy('order')->get() as $index=>$image){
            $this->images[($image->order-1)] = $image->path;
        }
    }

    public function roomTypeVisibleById($id, $value): void
    {
        try {
            $room_type = HotelRoomType::find($id);
            if ($room_type) {
                $room_type->visible = $value;
                $room_type->save();
            }
        } catch (\Exception $e) {
            ddd('roomTypeVisibleById 처리 오류 개발자 문의');
        }
        $this->reLoad();
        $this->render();
    }

    public function RoomTypeSubmit()
    {
        $validate = collect($this->validate($this->rules()));

        if ($this->image !== '' && $this->image !== null ) {
            //$file = Storage::disk('s3-Public')->put('/images/' . $this->hotel->id . '/room-type', $this->image);
            $file = $this->image->store('/images/' . $this->hotel->id . '/room-type', 's3');
        }
        $roomType = HotelRoomType::Create([
            'hotel_id' => $this->hotel->id,
            'user_id' => auth()->user()->id,
            'visible' => 0,
            'name' => $validate->get('name'),
            'main_explanation' => $validate->get('main_explanation') ?? '',
            'sub_explanation' => $validate->get('sub_explanation') ?? '',
            'order' => $validate->get('order'),
            'image' => $file ?? '',
            'sold_out' => $validate->get('sold_out'),
            'upgrade' => $validate->get('upgrade'),
            'sale_possibility_count' => $validate->get('sale_possibility_count') ?? 0,
        ]);

        if($this->images){
            RoomTypeImage::whereRoomTypeId($roomType->id)->delete();
            foreach ($this->images as $index=>$item) {
                if(!is_string($item)){
                    $file = $item->store('/images/' . $this->hotel->id . '/room-type-images', 's3');
                }else{
                    $file=$item;
                }
                RoomTypeImage::create([
                    'hotel_id'=>$this->hotel->id,
                    'room_type_id'=>$roomType->id,
                    'admin_id'=>auth()->user()->id,
                    'name'=>$roomType->name,
                    'order'=>($index+1),
                    'path'=>$file
                ]);
            }
            $this->reset('images');
        }

        \Session::flash('message', "룸 타입 저장 완료");
        $this->formReset();
        $this->reLoad();
        $this->render();
    }

    public function RoomTypeUpdateSubmit()
    {
        if($this->preview_image){
            if ($this->image !== '' && $this->image !== null ) {
                $file = $this->image->store('/images/' . $this->hotel->id . '/room-type', 's3');
            }
            $validate = collect($this->validate([
                'name' => 'required',
                'main_explanation' => 'required',
                'sub_explanation' => 'required',
                'order' => 'required|integer',
                'image' => 'image|max:1024|mimes:png,jpg',
                'sold_out' => 'required',
                'upgrade' => 'required',
                'sale_possibility_count' => 'integer',
            ]));
        }else{
            $file = $this->roomType->image;
            $validate = collect($this->validate([
                'name' => 'required',
                'main_explanation' => 'required',
                'sub_explanation' => 'required',
                'order' => 'required|integer',
                'sold_out' => 'required',
                'upgrade' => 'required',
                'sale_possibility_count' => 'integer',
            ]));
        }

        $this->roomType->update([
            'user_id' => auth()->user()->id,
            'name' => $validate->get('name'),
            'main_explanation' => $validate->get('main_explanation'),
            'sub_explanation' => $validate->get('sub_explanation'),
            'order' => $validate->get('order'),
            'image' => $file ?? null,
            'sold_out' => $validate->get('sold_out'),
            'upgrade' => $validate->get('upgrade'),
            'sale_possibility_count' => $validate->get('sale_possibility_count') ?? 0,
        ]);

        if($this->images){
            RoomTypeImage::whereRoomTypeId($this->roomType->id)->delete();
            foreach ($this->images as $index=>$item) {
                if(!is_string($item)){
                    $file = $item->store('/images/' . $this->hotel->id . '/room-type-images', 's3');
                }else{
                    $file=$item;
                }
                RoomTypeImage::create([
                    'hotel_id'=>$this->hotel->id,
                    'room_type_id'=>$this->roomType->id,
                    'admin_id'=>auth()->user()->id,
                    'name'=>$this->roomType->name,
                    'order'=>($index+1),
                    'path'=>$file
                ]);
            }
            $this->reset('images');
        }
        \Session::flash('message', "룸 타입 수정 완료");
        $this->formReset();
        $this->reLoad();
        $this->render();
    }

    public function visibleType($type)
    {
        $this->visible_type = $type;
        $this->reLoad();
        $this->render();
    }

    public function formReset(): void
    {
        $this->form_show= false;
        $this->roomType= null;
        $this->reset([
            'name', 'main_explanation', 'sub_explanation',
            'order', 'visible',
            'image',
            'sold_out', 'upgrade', 'sale_possibility_count',
        ]);
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.hotel.room-types');
    }
}
