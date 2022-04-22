<?php

namespace App\Http\Livewire;

use App\Alternativa;
use App\Criterio;
use App\TotalAlternativaAlternativaCriterio;
use App\TotalAlternativaCriterio;
use App\TotalCriterioCriterio;
use Illuminate\Support\Facades\DB;
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

    public function calculateTotalCriterio($id_criterio)
    {
        $total = TotalCriterioCriterio::calculateTotal($id_criterio);
        DB::beginTransaction();
        try {
            $total_criterio_criterio = TotalCriterioCriterio::where(['id_criterio' => $id_criterio])->update(['total' => $total]);
            DB::commit();
            return back()->with(['success' => "Feito com sucesso"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function calculateTotalAlternativaCriterio($id_criterio, $id_alternativa)
    {
        $total = TotalAlternativaAlternativaCriterio::calculateTotal($id_criterio, $id_alternativa);
        DB::beginTransaction();
        try {
            $total_alternativa_criterio = TotalAlternativaAlternativaCriterio::where(['id_criterio' => $id_criterio, 'id_alternativa' => $id_alternativa])->update(['total' => $total]);
            DB::commit();
            return back()->with(['success' => "Feito com sucesso"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function calculateValorPrioridade($id_criterio, $id_alternativa)
    {
        $total = TotalAlternativaCriterio::calculateValor($id_alternativa, $id_criterio);
        DB::beginTransaction();
        try {
            $total_alternativa_criterio = TotalAlternativaCriterio::where(['id_criterio' => $id_criterio, 'id_alternativa' => $id_alternativa])->first();
            if ($total_alternativa_criterio) {
                $total_alternativa_criterio = TotalAlternativaCriterio::where([
                    'id_criterio' => $id_criterio,
                    'id_alternativa' => $id_alternativa
                ])->update(['valor' => $total]);
            } else {
                $total_alternativa_criterio = TotalAlternativaCriterio::create([
                    'id_alternativa' => $id_alternativa,
                    'id_criterio' => $id_criterio,
                    'valor' => $total,
                    'estado' => "on",
                ]);
            }

            DB::commit();
            return back()->with(['success' => "Feito com sucesso"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function calculateTotalPrioridade($id_alternativa)
    {
        $total = TotalAlternativaCriterio::calculateTotal($id_alternativa);
        DB::beginTransaction();
        try {

            $total_alternativa_criterio = TotalAlternativaCriterio::where([
                'id_alternativa' => $id_alternativa
            ])->update(['total' => $total]);
            
            DB::commit();
            return back()->with(['success' => "Feito com sucesso"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage()]);
        }
    }
}