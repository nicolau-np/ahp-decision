<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriterioCriteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterio_criterios', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('code')->nullable();
            $table->bigInteger('id_criterio1')->unsigned()->index();
            $table->bigInteger('id_criterio2')->unsigned()->index();
            $table->decimal('valor', 16, 2);
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('criterio_criterios', function (Blueprint $table) {
            $table->foreign('id_criterio1')->references('id')->on('criterios')->onUpdate('cascade');
            $table->foreign('id_criterio2')->references('id')->on('criterios')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criterio_criterios');
    }
}