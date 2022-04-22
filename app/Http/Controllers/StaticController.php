<?php

namespace App\Http\Controllers;

use App\AlternativaAlternativaCriterio;
use App\Criterio;
use App\CriterioCriterio;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    public static function getValueCriterio($id_criterio1, $id_criterio2)
    {
        $criterio = CriterioCriterio::where(['id_criterio1' => $id_criterio1, 'id_criterio2' => $id_criterio2])->first();
        return $criterio;
    }

    public static function getTotalLinha($id_criterio1)
    {
        $total = CriterioCriterio::where(['id_criterio1' => $id_criterio1])->sum('valor');
        return $total;
    }

    public static function getAlternativaValue($id_criterio, $id_alternativa1, $id_alternativa2)
    {
        $alternativa = AlternativaAlternativaCriterio::where([
            'id_criterio' => $id_criterio,
            'id_alternativa1' => $id_alternativa1,
            'id_alternativa2' => $id_alternativa2,
        ])->first();
        return $alternativa;
    }

    public static function getTotalLinhaAlternativa($id_alternativa1, $id_criterio)
    {
        $total = AlternativaAlternativaCriterio::where(['id_alternativa1' => $id_alternativa1, 'id_criterio' => $id_criterio])->sum('valor');
        return $total;
    }
}