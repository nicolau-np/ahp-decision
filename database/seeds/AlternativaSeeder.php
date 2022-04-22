<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternativaSeeder extends Seeder
{
    static $alternativas = [
        [
            'alternativa' => "Projecto A",
            'sigla' => "A",
            'estado' => "on",
        ], [
            'alternativa' => "Projecto B",
            'sigla' => "B",
            'estado' => "on",
        ], [
            'alternativa' => "Projecto C",
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