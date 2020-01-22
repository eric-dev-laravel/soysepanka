<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguajesJobpositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobpositions_languajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jobposition');
            $table->string('name');
            $table->string('read');
            $table->string('write');
            $table->string('conversation');
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
        Schema::dropIfExists('jobpositions_languajes');
    }
}
