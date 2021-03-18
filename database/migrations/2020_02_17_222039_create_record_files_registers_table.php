<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordFilesRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_files_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_employee')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_record')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->string('expiration_date')->nullable();
            $table->string('proof')->nullable();
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
        Schema::dropIfExists('record_files_registers');
    }
}
