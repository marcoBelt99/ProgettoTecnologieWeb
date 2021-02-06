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
            $table->id(); // Chiave primaria: metto bigIncremets altrimenti mi da errori nella FK
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('CAP')->nullable();
            $table->string('city')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('points')->nullable();
            $table->rememberToken();
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
