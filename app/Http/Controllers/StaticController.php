<?php

namespace App\Http\Controllers;

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
}