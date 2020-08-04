<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordBeneficiariesDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_beneficiaries_det', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('record_beneficiaries_id')->unsigned();
            $table->foreign('record_beneficiaries_id')->references('id')->on('record_beneficiaries');

            $table->string('beneficiarie_name', 255)->nullable();
            $table->date('date_birth_beneficiarie')->nullable();
            $table->string('file_birth_certificate_beneficiarie', 255)->nullable();
            $table->string('type_beneficiarie', 10)->nullable();

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
        Schema::dropIfExists('record_beneficiaries_det');
    }
}
