<?php

namespace App\Http\Livewire\Hotel\Copy;

use App\Hotel;
use Illuminate\Support\Arr;
use Livewire\Component;

class Core extends Component
{
    /* Request */

    /* Response */

    /* Data */
    public $targetHotel;
    public $target_hotel;
    public $import_hotel;
    public $rooms;
    public $room_types;

    public $copyCheckbox;
    /* Alpine */

    public function mount(){
        if($this->target_hotel === null){
            $this->targetHotel = Hotel::where('curator', '=', 'N')->first();

            $rooms_index=0;
            $room_types_index=0;
            foreach ($this->targetHotel->rooms->where('disable', '=', 'N') as $room){
                $this->rooms[$rooms_index] = true;
                $rooms_index++;
            }
            foreach ($this->targetHotel->room_types->where('visible', '=', '1') as $roomType){
                $this->room_types[$room_types_index] = true;
                $room_types_index++;
            }
        }
    }

    public function copyCheckboxAllCheck(){
        if(isset($this->copyCheckbox['all_check']) && $this->copyCheckbox['all_check']){
            $this->copyCheckbox['curator']=true;
            $this->copyCheckbox['images']=true;
            $this->copyCheckbox['rooms']=true;
            $this->copyCheckbox['room_types']=true;
            $this->copyCheckbox['cancellation_refund_policies']=true;
            $this->copyCheckbox['check_points']=true;
            $this->copyCheckbox['faqs']=true;
            $this->copyCheckbox['reviews']=true;
        }elseif(!isset($this->copyCheckbox['all_check']) || (isset($this->copyCheckbox['all_check']) && !$this->copyCheckbox['all_check'])){
            $this->copyCheckbox['curator']=false;
            $this->copyCheckbox['images']=false;
            $this->copyCheckbox['rooms']=false;
            $this->copyCheckbox['room_types']=false;
            $this->copyCheckbox['cancellation_refund_policies']=false;
            $this->copyCheckbox['check_points']=false;
            $this->copyCheckbox['faqs']=false;
            $this->copyCheckbox['reviews']=false;
        }
        $this->clearCopyCheckbox();
    }

    public function updatedCopyCheckbox($value){
        if(!$value){
            $this->copyCheckbox['all_check']=false;
            $this->clearCopyCheckbox();
        }else{
            $this->clearCopyCheckbox();
            if(count($this->copyCheckbox) === 8){
                $this->copyCheckbox['all_check'] = true;
            }
        }
    }
    public function clearCopyCheckbox(){
        $this->copyCheckbox = Arr::where($this->copyCheckbox, function ($value, $key){
            return $value === true ? $value : null;
        });
    }

    public function hotelChangeCheck($target){
        if($target === 'target'){
            $this->targetHotel = Hotel::find($this->target_hotel);
        }
    }

    public function copySubmit(){
        session()->flash('result', '호텔 복사 완료');
        if($this->import_hotel!==null&&$this->import_hotel!==''){
            $copyHotel = Hotel::find($this->import_hotel);
        }else{
            $copyHotel = $this->targetHotel->replicate();
        }
        $copyHotel->status = 1;
        $copyHotel->curator = 'Y';
        $copyHotel->push();
        $copyHotel->option()->save($this->targetHotel->option->replicate()); /* 옵션은 필수 값 */

        $checkbox = collect($this->copyCheckbox);
        $checkbox->each(fn($item, $key) => $this->copyHotel($copyHotel, $key));
    }

    private function copyHotel($copyHotel, $key){
        switch ($key){
            case 'curator' :
                $copyHotel->curator = 'Y';
                $copyHotel->save();
            break;
            case 'images' :
                $index=0;
                foreach ($this->targetHotel->images->where('disable', '=', 'N')->where('type', '=', '0') as $item){
                    if($this->room_types[$index]){
                        $copyHotel->room_types()->save($item->replicate());
                    }
                    $index++;
                }
                break;
            case 'rooms' :
                $index=0;
                foreach ($this->targetHotel->rooms->where('disable', '=', 'N') as $item){
                    if($this->rooms[$index]){
                        $item->room_option=null;
                        $item->room_sold_out=null;
                        $item->room_upgrade=null;
                        $copyHotel->rooms()->save($item->replicate());
                    }
                    $index++;
                }
            break;
            case 'room_types' :
                $index=0;
                foreach ($this->targetHotel->room_types->where('visible', '=', '1') as $item){
                    if($this->room_types[$index]){
                        $copyHotel->room_types()->save($item->replicate());
                    }
                    $index++;
                }
            break;
            case 'cancellation_refund_policies' :
                $copyHotel->cancellationPolicy()->save($this->targetHotel->cancellationPolicy->replicate());
            break;
            case 'check_points' :
                foreach ($this->targetHotel->checkPoints->where('disable', '=', 'N') as $item){
                    $copyHotel->checkPoints()->save($item->replicate());
                }
            break;
            case 'faqs' :
                foreach ($this->targetHotel->faqs as $item){
                    $copyHotel->faqs()->save($item->replicate());
                }
            break;
            case 'reviews' :
                foreach ($this->targetHotel->reviews as $item){
                    $copyHotel->reviews()->save($item->replicate());
                }
            break;
        }
    }

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.hotel.copy.core');
	}
}
