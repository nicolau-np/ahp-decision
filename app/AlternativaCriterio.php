<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlternativaCriterio extends Model
{
    protected $tabale = "alternativa_criterios";

    protected $fillable = [
        'code',
        'id_alternativa',
        'id_criterio',
        'valor',
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