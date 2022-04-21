<?php

namespace App\Http\Livewire\Criterios;

use App\Criterio;
use Livewire\Component;

class Listar extends Component
{
    public function render()
    {
        $criterios = Criterio::all();
        $data = [
            'title' => "Critérios",
            'menu' => "Critérios",
            'submenu' => "Listar",
            'type' => "home",
            'getCriterios' => $criterios,
        ];
        return view('livewire.criterios.listar', $data);
    }
}