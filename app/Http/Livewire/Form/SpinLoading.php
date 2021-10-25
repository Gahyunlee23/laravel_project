<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;

class SpinLoading extends Component
{
    public $borderTopColor;
    public $loadingText;

    public function render()
    {
        return view('livewire.form.spin-loading');
    }
}
