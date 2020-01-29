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
            $table->integer('id_mark')->nullable();
            $table->integer('id_direction')->nullable();
            $table->integer('id_area')->nullable();
            $table->integer('id_department')->nullable();
            $table->integer('id_level')->nullable();
            $table->integer('id_boss_position')->nullable();
            $table->integer('id_workshifts')->nullable();
            $table->integer('id_gender')->nullable();
            $table->integer('id_marital_status')->nullable();
            $table->string('name');
            $table->text('objective')->nullable();
            $table->text('activities')->nullable();
            $table->text('responsabilities')->nullable();
            $table->text('knowledges')->nullable();
            $table->text('competitions')->nullable();
            $table->text('tools')->nullable();
            $table->text('education_level')->nullable();
            $table->integer('places')->nullable();
            $table->text('description')->nullable();
            $table->string('years_experience')->nullable();
            $table->string('age_max')->nullable();
            $table->string('age_min')->nullable();
            $table->text('equitment')->nullable();
            $table->text('benefits')->nullable();
            $table->text('available')->nullable();
            $table->string('salary_range')->nullable();
            $table->string('salary_max')->nullable();
            $table->string('salary_min')->nullable();
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
