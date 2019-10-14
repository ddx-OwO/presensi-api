<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('username', 150)->unique();
            $table->string('password', 255);
            $table->string('email', 150)->unique();
            $table->string('name');
            $table->string('nisn')->nullable();
            $table->string('nip')->nullable();
            $table->unsignedTinyInteger('gender')->default(0);
            $table->text('address')->nullable();
            $table->date('dob')->default('2000-01-01');
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
        Schema::dropIfExists('users');
    }
}
