<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    protected $table = "criterios";

    protected $fillable = [
        'criterio',
        'sigla',
        'estado',
    ];

    public function alternativa_alternativa_criterios()
    {
        return $this->hasMany(AlternativaAlternativaCriterio::class, 'id_criterio', 'id');
    }

    public function criterio_criterios1()
    {
        return $this->hasMany(CriterioCriterio::class, 'id_criterio1', 'id');
    }

    public function criterio_criterios2()
    {
        return $this->hasMany(CriterioCriterio::class, 'id_criterio2', 'id');
    }

    public function alternativa_criterios()
    {
        return $this->hasMany(AlternativaCriterio::class, 'id_criterio', 'id');
    }

    public function total_criterio_criterios()
    {
        return $this->hasMany(TotalCriterioCriterio::class, 'id_criterio', 'id');
    }

    public function total_alternativa_alternativa_criterios()
    {
        return $this->hasMany(TotalAlternativaAlternativaCriterio::class, 'id_criterio', 'id');
    }

    public function total_alternativa_criterios(){
        return $this->hasMany(TotalAlternativaCriterio::class, 'id_criterio', 'id');
    }
}