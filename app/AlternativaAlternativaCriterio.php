<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlternativaAlternativaCriterio extends Model
{
    protected $table = "alternativa_alternativa_criterios";

    protected $fillable = [
        'code',
        'id_alternativa1',
        'id_alternativa2',
        'id_criterio',
        'valor',
        'estado',
    ];

    public function alternativas1()
    {
        return $this->belongsTo(Alternativa::class, 'id_alternativa1', 'id');
    }

    public function alternativas2()
    {
        return $this->belongsTo(Alternativa::class, 'id_alternativa2', 'id');
    }

    public function criterios()
    {
        return $this->belongsTo(Criterio::class, 'id_criterio', 'id');
    }
}