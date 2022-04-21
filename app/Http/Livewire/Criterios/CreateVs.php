<?php

namespace App\Http\Livewire\Criterios;

use App\Criterio;
use App\CriterioCriterio;
use Livewire\Component;

class CreateVs extends Component
{
    public $getCriterio;
    public $valor, $criterio;

    public function mount($id_criterio)
    {
        $criterio = Criterio::find($id_criterio);
        if (!$criterio) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $this->getCriterio = $criterio;
    }

    public function submit()
    {
        $this->validate([
            'valor' => ['required'],
            'criterio' => ['required'],
        ]);

        
    }

    public function render()
    {
        $criterios = Criterio::where('id', '!=', $this->getCriterio->id)->get();
        $criteriosvs = CriterioCriterio::where(['id_criterio1' => $this->getCriterio->id])->get();
        $data = [
            'title' => "Critérios-VS",
            'menu' => "Critérios-VS",
            'submenu' => "Novo",
            'type' => "home",
            'getCriteriosVS' => $criteriosvs,
            'getCriterios' => $criterios,
        ];
        return view('livewire.criterios.create-vs', $data);
    }
}