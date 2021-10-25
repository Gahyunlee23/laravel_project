<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

class MyPage extends Component
{
    public $page ='main';
    public $tab ='alert-lists';

//    protected $queryString = ['tab'=>['except' => '']];

    public function render()
    {
        return view('livewire.customer.my-page');
    }
}
