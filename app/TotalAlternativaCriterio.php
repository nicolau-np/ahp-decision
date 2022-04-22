<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TotalAlternativaCriterio extends Model
{
    protected $table = "total_alternativa_criterios";

    protected $fillable = [
        'id_alternativa',
        'id_criterio',
        'valor',
        'total',
        'estado',
    ];

    public function alternativas()
    {
        return $this->belongsTo(Alternativa::class, 'id_alternativa', 'id');
    }

    public function criterios()
    {
        return $this->belongsTo(Criterio::class, 'id_criterio', 'id');
    }

    public static function calculateValor($id_alternativa, $id_criterio)
    {
        $total_alternativa_criterio = TotalAlternativaAlternativaCriterio::where(['id_alternativa' => $id_alternativa, 'id_criterio' => $id_criterio])->first();
        $total_criterio_criterio = TotalCriterioCriterio::where(['id_criterio' => $id_criterio])->first();
        $total = $total_alternativa_criterio->total * $total_criterio_criterio->total;
        return $total;
    }

    public static function calculateTotal($id_alternativa){
        $total_alternativa_criterio = TotalAlternativaCriterio::where(['id_alternativa' => $id_alternativa])->first();
        $soma = TotalAlternativaCriterio::sum('valor');
        $total = $total_alternativa_criterio->valor / $soma;

        return $total;
    }
}