<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramacionvehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProgVehiculos', function (Blueprint $table) {
            $table->increments('ID_ProgVeh');
            $table->timestamps();
            $table->date('ProgVehFecha');
            $table->integer('progVehKm');
            $table->boolean('ProgVehTurno');
            $table->boolean('ProgVehtipo');
            $table->boolean('ProgVehFeriado');
            $table->dateTime('ProgVehEntrada');
            $table->dateTime('ProgVehSalida');
            $table->dateTime('HoraMantenimientoInicio');
            $table->dateTime('HoraMAntenimientoFin');
            $table->unsignedInteger('FK_ProgMan');

            $table->foreign('FK_ProgMan')->references('ID_Mv')->on('MantenVehics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programacionvehiculo');
    }
}