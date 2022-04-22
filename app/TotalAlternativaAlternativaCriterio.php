<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TotalAlternativaAlternativaCriterio extends Model
{
    protected $table = "total_alternativa_alternativa_criterios";

    protected $fillable = [
        'id_alternativa',
        'id_criterio',
        'valor',
        'total',
        'estado',
    ];

    public function criterios()
    {
        return $this->belongsTo(TotalAlternativaAlternativaCriterio::class, 'id_criterio', 'id');
    }

    public function alternativas()
    {
        return $this->belongsTo(Alternativa::class, 'id_alternativa', 'id');
    }

    public static function calculateTotal($id_criterio, $id_alternativa)
    {
        $total_alternativa_criterio = TotalAlternativaAlternativaCriterio::where(['id_criterio' => $id_criterio, 'id_alternativa'=>$id_alternativa])->first();
        $soma = TotalAlternativaAlternativaCriterio::where(['id_criterio'=>$id_criterio])->sum('valor');
        $total = $total_alternativa_criterio->valor / $soma;

        return $total;
    }
}