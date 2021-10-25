<?php

namespace App\Http\Livewire\Admin\Banner;

use Livewire\Component;


class Core extends Component {
    public $banner;
    public $type;

    /**
     * Get the view / contents that represent the component.
     * @return \Illuminate\View\View|string
     */
    public function render() {
        return view('livewire.admin.banner.core');
    }
}
