<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->Increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('type_period')->nullable();
            $table->integer('period')->nullable();
            $table->string('company')->nullable();
            $table->integer('year')->nullable();
            $table->string('file')->nullable();
        
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
        Schema::dropIfExists('payroll');
    }
}
