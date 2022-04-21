<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternativaSeeder extends Seeder
{
    static $alternativas = [
        [
            'alternativa' => "Alternativa 1",
            'sigla' => "A",
            'estado' => "on",
        ], [
            'alternativa' => "Alternativa 2",
            'sigla' => "B",
            'estado' => "on",
        ], [
            'alternativa' => "Alternativa 3",
            'sigla' => "C",
            'estado' => "on",
        ],
    ];
    public function run()
    {
        foreach (Self::$alternativas as $alternativas) {
            DB::table('alternativas')->insert($alternativas);
        }
    }
}