<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JobpositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_enterprise')->nullable();
            $table->integer('id_direction')->nullable();
            $table->integer('id_area')->nullable();
            $table->integer('id_department')->nullable();
            $table->integer('id_level')->nullable();
            $table->integer('id_boss_position')->nullable();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('origin')->nullable();
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
        Schema::dropIfExists('job_positions');
    }
}
