<?php

namespace App\Http\Livewire\Inactive;

use Livewire\Component;

class InactiveComponent extends Component
{
    public function render()
    {
        return view('livewire.inactive.inactive-component')->layout('livewire.base.inactive_base');
    }
}
