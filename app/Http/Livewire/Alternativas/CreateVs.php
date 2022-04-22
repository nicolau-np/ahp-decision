<?php

namespace App\Http\Livewire\Alternativas;

use App\Alternativa;
use App\AlternativaAlternativaCriterio;
use App\Criterio;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateVs extends Component
{

    public $getAlternativa;
    public $alternativa, $criterio, $valor;

    public function mount($id_alternativa)
    {
        $alternativa = Alternativa::find($id_alternativa);
        if (!$alternativa) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $this->getAlternativa = $alternativa;
    }

    public function submit()
    {
        $this->validate([
            'alternativa' => ['required', 'integer'],
            'criterio' => ['required', 'integer'],
            'valor' => ['required', 'numeric'],
        ]);

        $data = [
            'id_alternativa1' => $this->getAlternativa->id,
            'id_alternativa2' => $this->alternativa,
            'id_criterio' => $this->criterio,
            'valor' => $this->valor,
            'estado' => "on",
        ];

        //verificar se ja cadastrou
        $alternativas = AlternativaAlternativaCriterio::where([
            'id_alternativa1' => $this->getAlternativa->id,
            'id_alternativa2' => $this->alternativa,
            'id_criterio' => $this->criterio
        ])->first();

        if ($alternativas) {
            return back()->with(['error' => "Já cadastrou esta partida"]);
        }

        DB::beginTransaction();
        try {
            //verificar se é o primeiro cadastro
            $alternativa = AlternativaAlternativaCriterio::where(['id_alternativa1' => $this->getAlternativa->id, 'id_criterio' => $this->criterio])->get();
            if ($alternativa->count() == 0) {
                //cadastra ele por ele mesmo e colocar valor1
                $alternativa = AlternativaAlternativaCriterio::create([
                    'id_alternativa1' => $this->getAlternativa->id,
                    'id_alternativa2' => $this->getAlternativa->id,
                    'id_criterio' => $this->criterio,
                    'valor' => 1,
                    'estado' => "on"
                ]);
            }
            $alternativa = AlternativaAlternativaCriterio::create($data);

            DB::commit();
            $this->clearFields();
            return back()->with(['success' => "Feito com sucesso"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function clearFields()
    {
        $this->alternativa = null;
        $this->criterio = null;
        $this->valor = null;
    }

    public function render()
    {
        $alternativas = Alternativa::where('id', '!=', $this->getAlternativa->id)->get();
        $criterios = Criterio::all();
        $alternativasvs = AlternativaAlternativaCriterio::where(['id_alternativa1' => $this->getAlternativa->id])->get();
        $data = [
            'title' => "Alternativa-VS",
            'menu' => "Alternativa-VS",
            'submenu' => "Novo",
            'type' => "home",
            'getAlternativasVS' => $alternativasvs,
            'getAlternativas' => $alternativas,
            'getCriterios' => $criterios,
        ];
        return view('livewire.alternativas.create-vs', $data);
    }
}