<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;

class Loading extends Component
{
    public $type='circle-spine';

    public $borderTopColor='#3498db';

    public $iconColorClass='text-white';

    public $loadingText='LOADING...';
    public string $loadingColorClass='text-white';

    public function render()
    {
        return view('livewire.form.loading');
    }
}
