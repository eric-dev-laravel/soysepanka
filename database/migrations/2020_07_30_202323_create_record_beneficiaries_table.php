<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_beneficiaries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_employee')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_record')->nullable();
            $table->string('spouse_name', 255)->nullable();
            $table->date('date_marriage')->nullable();
            $table->string('file_marriage', 255)->nullable();
            $table->string('father_name', 255)->nullable();
            $table->date('date_birth_father')->nullable();
            $table->string('file_birth_certificate_father', 255)->nullable();
            $table->string('mother_name', 255)->nullable();
            $table->date('date_birth_mother')->nullable();
            $table->string('file_birth_certificate_mother', 255)->nullable();

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
        Schema::dropIfExists('record_beneficiaries');
    }
}
