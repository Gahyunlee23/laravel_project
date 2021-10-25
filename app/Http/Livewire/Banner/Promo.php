<?php

namespace App\Http\Livewire\Banner;
use App\Banner;
use Carbon\Carbon;
use Livewire\Component;

class Promo extends Component {
    public $banners;
    public function mount() {
        $this->banners = \App\Banner::where('view', '=', 'promotion')
                                    ->where('end_dt', '>=', Carbon::now()->format('Y-m-d H:i:s'))
                                    ->where('start_dt', '<=', Carbon::now()->format('Y-m-d H:i:s'))
                                    ->get();
    }

    public function render() {
        return view('livewire.banner.promo');
    }
}
