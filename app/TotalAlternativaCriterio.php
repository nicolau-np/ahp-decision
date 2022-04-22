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
}