<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $data = [
            'title'=>"AHP Decision",
            'menu'=>"Home",
            'submenu'=>"Home",
            'type'=>"home"
        ];
        return view('livewire.home', $data);
    }
}