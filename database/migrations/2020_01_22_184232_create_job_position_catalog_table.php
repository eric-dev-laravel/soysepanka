<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobPositionCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobpositions_catalog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_workshifts')->nullable();
            $table->integer('id_gender')->nullable();
            $table->integer('id_marital_status')->nullable();
            $table->string('name')->unique();
            $table->text('objective')->nullable();
            $table->text('education_level')->nullable();
            $table->string('experience')->nullable();
            $table->integer('places')->nullable();
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
        Schema::dropIfExists('jobpositions_catalog');
    }
}
