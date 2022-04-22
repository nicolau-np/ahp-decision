<?php

namespace App\Http\Livewire\Alternativas;

use App\Alternativa;
use Livewire\Component;

class Listar extends Component
{
    public function render()
    {
        $alternativas = Alternativa::all();
        $data = [
            'title'=>"Projectos",
            'menu'=>"Projectos",
            'submenu'=>"Listar",
            'type'=>"home",
            'getAlternativas'=>$alternativas,
        ];
        return view('livewire.alternativas.listar', $data);
    }
}