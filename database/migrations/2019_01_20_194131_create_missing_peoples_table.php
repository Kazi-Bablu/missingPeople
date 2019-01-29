<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissingPeoplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missing_peoples', function (Blueprint $table) {
            $table->increments('id');
            $table->text('missing_image')->nullable();
            $table->string('missing_person_name')->nullable();
            $table->string('missing_person_age')->nullable();
            $table->string('is_approve')->nullable();
            $table->integer('contact_number')->nullable();
            $table->dateTime('missing_date')->nullable();
            $table->integer('division_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('upazila_id')->nullable();
            $table->longText('missing_person_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missing_peoples');
    }
}
