<?php

namespace App\Http\Livewire\Enter;

use App\Enter;
use Livewire\Component;

class Manager extends Component
{
    protected $listeners = ['manager_store'=>'store', 'manager_checker'=>'checker'];

    public $manager_name;
    public $manager_rank;
    public $manager_email;
    public $manager_hp;

    public function render()
    {
        return view('livewire.enter.manager');
    }

    public function checker()
    {
        if($this->manager_name === null || $this->manager_rank === null || $this->manager_email === null || $this->manager_hp === null ){
            $this->dispatchBrowserEvent('alert', ['type' => 'manager','message'=>'호텔 담당자 정보를 모두 입력 후 신청해주세요.']);
            $this->dispatchBrowserEvent('manager-checker', ['data' => false]);
        }else{
            $this->dispatchBrowserEvent('manager-checker', ['data' => true]);
        }
    }
    public function store($enter_id): void
    {
        Enter::updateOrCreate([
            'id'=>$enter_id
        ],
        [
            'manager_name' => $this->manager_name,
            'manager_rank' => $this->manager_rank,
            'manager_email' => $this->manager_email,
            'manager_hp' => $this->manager_hp
        ]);
        $this->dispatchBrowserEvent('enter_end', ['data' => true]);
    }
}
