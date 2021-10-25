<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class ModifyName extends Component {
    public $name;

    public function mount() {
        $this->name = '';
    }

    public function render() {
        return view('livewire.auth.modify-password');
    }

    public function nameModify($name) {

        auth()->user()->name = $name;
        auth()->user()->save;
    }
}
