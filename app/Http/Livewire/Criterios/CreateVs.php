<?php

namespace App\Http\Livewire\Criterios;

use App\Criterio;
use App\CriterioCriterio;
use App\TotalCriterioCriterio;
use Illuminate\Support\Facades\DB;
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
            'valor' => ['required', 'numeric'],
            'criterio' => ['required', 'integer'],
        ]);

        //verificar se ja cadastrou
        $criterios = CriterioCriterio::where(['id_criterio1' => $this->getCriterio->id, 'id_criterio2' => $this->criterio])->first();
        if ($criterios) {
            return back()->with(['error' => "Já cadastrou esta partida"]);
        }

        $data = [
            'id_criterio1' => $this->getCriterio->id,
            'id_criterio2' => $this->criterio,
            'valor' => $this->valor,
            'estado' => "on"
        ];

        DB::beginTransaction();
        try {
            //verificar se é o primeiro cadastro
            $criterio = CriterioCriterio::where(['id_criterio1' => $this->getCriterio->id])->get();
            if ($criterio->count() == 0) {
                //cadastra ele por ele mesmo e colocar valor1
                $criterio = CriterioCriterio::create([
                    'id_criterio1' => $this->getCriterio->id,
                    'id_criterio2' => $this->getCriterio->id,
                    'valor' => 1,
                    'estado' => "on"
                ]);
                //cadasta ele no total de criterios
                $total_criterio = TotalCriterioCriterio::create([
                    'id_criterio' => $this->getCriterio->id,
                    'valor' => null,
                    'total' => null,
                    'estado' => "on",
                ]);
            }


            //salva em criterios
            $criterio = CriterioCriterio::create($data);

            //soma dos criterios
            $soma_criterios = CriterioCriterio::where(['id_criterio1' => $this->getCriterio->id])->sum('valor');
            //salvar valor criterio

            $total_criterio_criterio = TotalCriterioCriterio::where(['id_criterio' => $this->getCriterio->id])->update([
                'valor' => $soma_criterios,
            ]);

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
        $this->valor = null;
        $this->criterio = null;
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