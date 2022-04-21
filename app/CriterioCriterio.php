<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CriterioCriterio extends Model
{
    protected $table = "criterio_criterios";

    protected $fillable = [
        'code',
        'id_criterio1',
        'id_criterio2',
        'valor',
        'estado',
    ];

    public function criterios1(){
        return $this->belongsTo(Criterio::class, 'id_criterio1', 'id');
    }

    public function criterios2(){
        return $this->belongsTo(Criterio::class, 'id_criterio2', 'id');
    }
}