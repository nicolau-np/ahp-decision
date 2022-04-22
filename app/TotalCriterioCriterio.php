<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TotalCriterioCriterio extends Model
{
    protected $table = "total_criterio_criterios";

    protected $fillable = [
        'id_criterio',
        'valor',
        'total',
        'estado',
    ];

    public function criterios()
    {
        return $this->belongsTo(Criterio::class, 'id_criterio', 'id');
    }
}