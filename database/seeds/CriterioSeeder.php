<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriterioSeeder extends Seeder
{

    static $criterios = [
        [
            'criterio' => "Relatório de sustentabilidade",
            'sigla' => "C1",
            'estado' => "on",
        ], [
            'criterio' => "Plano de fertilização",
            'sigla' => "C2",
            'estado' => "on",
        ], [
            'criterio' => "Optimização da gestão de rega",
            'sigla' => "C3",
            'estado' => "on",
        ],
    ];

    public function run()
    {
        foreach (Self::$criterios as $criterios) {
            DB::table('criterios')->insert(
                $criterios
            );
        }
    }
}