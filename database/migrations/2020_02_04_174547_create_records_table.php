<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_employee')->nullable();
            $table->integer('id_user')->nullable();
            $table->string('picture')->nullable();
            $table->string('street')->nullable();
            $table->string('external_number')->nullable();
            $table->string('internal_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('government')->nullable();
            $table->string('proof_address')->nullable();
            $table->string('myLanguage')->nullable();
            $table->text('myTools')->nullable();
            $table->text('mySistems')->nullable();
            $table->text('myFunctions')->nullable();
            $table->text('availability')->nullable();
            $table->string('nss')->nullable();
            $table->string('blood')->nullable();
            $table->text('diseases')->nullable();
            $table->text('allergy')->nullable();
            $table->string('contact_name1')->nullable();
            $table->string('contact_phone1')->nullable();
            $table->string('contact_patent1')->nullable();
            $table->string('contact_name2')->nullable();
            $table->string('contact_phone2')->nullable();
            $table->string('contact_patent2')->nullable();
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
        Schema::dropIfExists('records');
    }
}
