<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalAlternativaCriteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_alternativa_criterios', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_alternativa')->unsigned()->index();
            $table->bigInteger('id_criterio')->unsigned()->index();
            $table->decimal('valor', 16, 2)->nullable();
            $table->decimal('total', 16, 3)->nullable();
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('total_alternativa_criterios', function (Blueprint $table) {
            $table->foreign('id_alternativa')->references('id')->on('alternativas')->onUpdate('cascade');
            $table->foreign('id_criterio')->references('id')->on('criterios')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('total_alternativa_criterios');
    }
}