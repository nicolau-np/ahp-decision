<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alternativa extends Model
{
    protected $table = "alternativas";

    protected $fillable = [
        'alternativa',
        'sigla',
        'estado',
    ];

    public function alternativa_alternativa_criterios1()
    {
        return $this->hasMany(AlternativaAlternativaCriterio::class, 'id_alternativa1', 'id');
    }

    public function alternativa_alternativa_criterios2()
    {
        return $this->hasMany(AlternativaAlternativaCriterio::class, 'id_alternativa2', 'id');
    }

    public function alternativa_criterios()
    {
        return $this->hasMany(AlternativaCriterio::class, 'id_criterio', 'id');
    }

    public function total_alternativa_alternativa_criterios()
    {
        return $this->hasMany(TotalAlternativaAlternativaCriterio::class, 'id_alternativa', 'id');
    }

    public function total_alternativa_criterios()
    {
        return $this->hasMany(TotalAlternativaCriterio::class, 'id_alternativa', 'id');
    }
}