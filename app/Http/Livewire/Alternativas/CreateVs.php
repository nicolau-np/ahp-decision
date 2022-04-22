<?php

namespace App\Http\Livewire\Alternativas;

use App\Alternativa;
use Livewire\Component;

class CreateVs extends Component
{

    public $getAlternativa;

    public function mount($id_alternativa)
    {
        $alternativa = Alternativa::find($id_alternativa);
        if (!$alternativa) {
            return back()->with(['error' => "Nao encontrou"]);
        }
    }

    public function render()
    {
        $alternativas = Alternativa::where([])->get();
        $data = [
            'title' => "Alternativa-VS",
            'menu' => "Alternativa-VS",
            'submenu' => "Novo",
            'type' => "home",
            'getAlternativasVS' => $alternativasvs,
            'getAlternativas' => $alternativas,
        ];
        return view('livewire.alternativas.create-vs', $data);
    }
}