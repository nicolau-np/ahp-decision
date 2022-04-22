<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalCriterioCriteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_criterio_criterios', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_criterio')->unsigned()->index();
            $table->decimal('valor', 16, 2)->nullable();
            $table->decimal('total', 16, 2)->nullable();
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('total_criterio_criterios', function (Blueprint $table) {
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
        Schema::dropIfExists('total_criterio_criterios');
    }
}