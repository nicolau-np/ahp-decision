<?php

namespace App\Http\Controllers;

use App\CriterioCriterio;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    public static function getValueCriterio($id_criterio1, $id_criterio2)
    {
        $criterio = CriterioCriterio::where(['id_criterio1' => $id_criterio1, 'id_criterio2' => $id_criterio2])->first();
        return $criterio;
    }
}