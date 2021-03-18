<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idempleado')->nullable();
            $table->string('nombre');
            $table->string('paterno')->nullable();
            $table->string('materno')->nullable();
            $table->string('fuente');
            $table->string('rfc');
            $table->string('curp')->nullable();
            $table->string('nss')->nullable();
            $table->string('correoempresa')->nullable();
            $table->string('correopersonal')->nullable();
            $table->date('nacimiento')->nullable();
            $table->string('sexo')->nullable();
            $table->string('civil')->nullable();
            $table->string('telefono')->nullable();
            $table->string('extension')->nullable();
            $table->string('celular')->nullable();
            $table->date('ingreso')->nullable();
            $table->date('fechapuesto')->nullable();
            $table->string('jefe')->nullable();
            $table->string('direccion')->nullable();
            $table->string('departamento')->nullable();
            $table->string('seccion')->nullable();
            $table->string('puesto')->nullable();
            $table->integer('id_puesto')->nullable();
            $table->string('grado')->nullable();
            $table->string('region')->nullable();
            $table->string('sucursal')->nullable();
            $table->string('idempresa')->nullable();
            $table->string('empresa')->nullable();
            $table->string('division')->nullable();
            $table->string('marca')->nullable();
            $table->string('centro')->nullable();
            $table->string('checador')->nullable();
            $table->string('turno')->nullable();
            $table->string('tiponomina')->nullable();
            $table->string('clavenomina')->nullable();
            $table->string('nombrenomina')->nullable();
            $table->string('generalista')->nullable();
            $table->string('relacion')->nullable();
            $table->string('contrato')->nullable();
            $table->string('horario')->nullable();
            $table->string('jornada')->nullable();
            $table->string('calculo')->nullable();
            $table->string('vacaciones')->nullable();
            $table->string('flotante')->nullable();
            $table->string('base')->nullable();
            $table->string('rol')->nullable();
            $table->string('password')->nullable();
            $table->string('extra1')->nullable();
            $table->string('extra2')->nullable();
            $table->string('extra3')->nullable();
            $table->string('extra4')->nullable();
            $table->string('extra5')->nullable();
            $table->date('fecha')->nullable();
            $table->string('version')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
