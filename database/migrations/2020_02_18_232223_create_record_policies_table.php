<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_policies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_employee')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_record')->nullable();
            $table->string('type')->nullable();
            $table->string('company')->nullable();
            $table->string('number')->nullable();
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
        Schema::dropIfExists('record_policies');
    }
}
