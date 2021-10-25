<?php

namespace App\Http\Livewire\Banner;

use Carbon\Carbon;
use Livewire\Component;

class Saletime extends Component {

    public $time;
    public $diffTime;

    public function mount(){
        $this->diffTime = Carbon::parse($this->diffTime)->timestamp;
        $this->time();
    }
    public function time(){
        $this->time = $this->diffTime - Carbon::now()->timestamp;
    }
    public function render() {
        return view('livewire.banner.saletime');
    }
}
