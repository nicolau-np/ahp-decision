<?php

namespace App\Http\Livewire;

use App\Alternativa;
use App\Criterio;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $criterios = Criterio::all();
        $alternativas = Alternativa::all();
        $data = [
            'title' => "AHP Decision",
            'menu' => "Home",
            'submenu' => "Home",
            'type' => "home",
            'getCriterios' => $criterios,
            'getAlternativas' => $alternativas,
        ];
        return view('livewire.home', $data);
    }
}