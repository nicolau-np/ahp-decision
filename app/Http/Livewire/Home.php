<?php

namespace App\Http\Livewire;

use App\Criterio;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $criterios = Criterio::all();
        $data = [
            'title' => "AHP Decision",
            'menu' => "Home",
            'submenu' => "Home",
            'type' => "home",
            'getCriterios' => $criterios,
        ];
        return view('livewire.home', $data);
    }
}