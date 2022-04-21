<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternativaAlternativaCriteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternativa_alternativa_criterios', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('code');
            $table->bigInteger('id_alternativa1')->unsigned()->index();
            $table->bigInteger('id_alternativa2')->unsigned()->index();
            $table->bigInteger('id_criterio')->unsigned()->index();
            $table->decimal('valor',16,2);
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternativa_alternativa_criterios');
    }
}