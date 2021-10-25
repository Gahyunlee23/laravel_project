<?php

namespace App\Http\Livewire\Enter;

use App\Enter;
use App\EnterRoom;
use Livewire\Component;

class Room extends Component
{

    protected $listeners = ['room_append'=>'add', 'room_store'=>'store', 'room_checker'=>'checker'];

    public $index;
    public $inputs = [0];

    public $i = 0;
    public $current_i = 0;

    public $type;
    public $supply_price_month;
    public $supply_price_3_weeks;
    public $supply_price_2_weeks;
    public $supply_price_1_weeks;
    public $supply_price_short_day;

    public function render()
    {
        return view('livewire.enter.room');
    }

    public function add()
    {
        if( (!isset($this->type[$this->i], $this->supply_price_month[$this->i], $this->supply_price_3_weeks[$this->i], $this->supply_price_2_weeks[$this->i], $this->supply_price_1_weeks[$this->i], $this->supply_price_short_day[$this->i]))){
            $this->dispatchBrowserEvent('alert', ['type' => 'room_page','message'=>($this->i+1).'번 객실 정보 모두 작성후 추가 가능합니다.']);
        }else{
            $this->i++;
            $this->inputs=array_merge($this->inputs ,[$this->i]);
            $this->current_i=$this->i;
        }
    }

    public function room_page($i)
    {
        if($i !== 0
            && ( $this->type[$this->i-1] || $this->supply_price_month[$this->i-1] || $this->supply_price_3_weeks[$this->i-1] || $this->supply_price_2_weeks[$this->i-1] || $this->supply_price_1_weeks[$this->i-1] || $this->supply_price_short_day[$this->i-1] )
            && ($this->type[$i-1] === null || $this->supply_price_month[$i-1] === null || $this->supply_price_3_weeks[$i-1] === null || $this->supply_price_2_weeks[$i-1] === null || $this->supply_price_1_weeks[$i-1] === null || $this->supply_price_short_day[$i-1] === null)){

            $this->dispatchBrowserEvent('alert', ['type' => 'room_page','message'=>'이전 룸 정보 모두 작성후 가능합니다.']);
        }else{
            $this->current_i=$i;
        }
        //ddd($this->type[$i],$this->supply_price_month[$i],$this->supply_price_3_weeks[$i],$this->supply_price_2_weeks[$i],$this->supply_price_1_weeks[$i],$this->supply_price_short_day[$i]);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    private function resetInputFields(){
        $this->type = '';
        $this->supply_price_month = '';
    }


    public function checker()
    {
        if($this->type === null || $this->supply_price_month === null || $this->supply_price_3_weeks === null
            || $this->supply_price_2_weeks === null || $this->supply_price_1_weeks === null || $this->supply_price_short_day === null){

            /*$check = [];
            $check_message = [];
            foreach ($this->inputs as $item) {
                $check=array_merge($check, [
                    'type.'.$item => 'required',
                    'supply_price_month.'.$item => 'required',
                    'supply_price_3_weeks.'.$item => 'required',
                    'supply_price_2_weeks.'.$item => 'required',
                    'supply_price_1_weeks.'.$item => 'required',
                    'supply_price_short_day.'.$item => 'required',
                ]);
                $check_message=array_merge($check_message, [
                    'type.'.$item.'required' => '객실 타입을 입력해주세요',
                    'supply_price_month.'.$item.'required' => '한 달 살기 공급가를 입력해주세요',
                    'supply_price_3_weeks.'.$item.'required' => '3주 살기 공급가를 입력해주세요',
                    'supply_price_2_weeks.'.$item.'required' => '2주 살기 공급가를 입력해주세요',
                    'supply_price_1_weeks.'.$item.'required' => '1주 살기 공급가를 입력해주세요',
                    'supply_price_short_day.'.$item.'required' => '단기 거주 공급가를 입력해주세요',
                ]);
            }
            $validatedDate = $this->validate(
                $check,
                $check_message
            );*/

            $this->dispatchBrowserEvent('alert', ['type' => 'room','message'=>'호텔 룸 정보를 모두 입력 후 신청해주세요.']);
            $this->dispatchBrowserEvent('room-checker', ['data' => false]);
        }else{
            $this->dispatchBrowserEvent('room-checker', ['data' => true]);
        }
    }

    public function store($enter_id): void
    {

        foreach ($this->type as $key => $value) {
           EnterRoom::create([
               'enter_id'=>$enter_id,
               'type' => $this->type[$key],
               'supply_price_month' => $this->supply_price_month[$key],
               'supply_price_3_weeks' => $this->supply_price_3_weeks[$key],
               'supply_price_2_weeks' => $this->supply_price_2_weeks[$key],
               'supply_price_1_weeks' => $this->supply_price_1_weeks[$key],
               'supply_price_short_day' => $this->supply_price_short_day[$key]
           ]);
        }

    }

}
