<?php

namespace App\Http\Livewire;

use App\Alternativa;
use App\Criterio;
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
}