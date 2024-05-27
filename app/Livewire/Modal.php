<?php

namespace App\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $modal;
    public function render()
    {
        return view('livewire.modal');
    }
}
