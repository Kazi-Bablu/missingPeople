<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullabel();
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('verified')->default(0)->nullabel();
            $table->string('email_token')->nullable();
            $table->string('user_role')->nullable();
            $table->string('occupation')->nullable();
            $table->integer('division_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('upazila_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $this->initializeTable('users');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

    /**
     * @param $table
     */
    public function initializeTable($table)
    {
        DB::table($table)->insert([
            [
                'name'=>'Admin',
                'password'=>bcrypt('123456'),
                'email'=>'kazibablubif@gmail.com',
                'user_role'=>'Admin',
                'verified'=>'1'
            ]
        ]);
    }

}
