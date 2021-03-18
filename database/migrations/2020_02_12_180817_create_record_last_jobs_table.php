<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordLastJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_last_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_employee')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_record')->nullable();
            $table->string('last_jobPosition')->nullable();
            $table->string('last_enterprise')->nullable();
            $table->string('period_init')->nullable();
            $table->string('period_end')->nullable();
            $table->string('salary')->nullable();
            $table->string('reason_separation')->nullable();
            $table->text('activities')->nullable();
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
        Schema::dropIfExists('record_last_jobs');
    }
}
