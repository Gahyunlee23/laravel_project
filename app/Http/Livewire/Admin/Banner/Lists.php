<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Banner;
use Livewire\Component;

class Lists extends Component
{
    /**
     * Get the view / contents that represent the component.
     * @return \Illuminate\View\View|string
     */

    public $banners;

    /* mount를 이용해서, 현재 뷰 블레이드에서 $banners로 접근이 가능해짐. 이 부분이 없다면 db에 계속 접근해서 모델을 불러와야 함, 서버 과부하 문제 걸릴 수 있음. \App\Banner::get() 이렇게 쓰지 않아도 됨*/
    public function mount() {
        $this->banners = Banner::get();
    }

    public function render() {
        return view('livewire.admin.banner.lists');
    }
}
