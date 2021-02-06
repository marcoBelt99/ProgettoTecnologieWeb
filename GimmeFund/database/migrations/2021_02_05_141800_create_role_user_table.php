<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Creo una tabella per i ruoli (l'ho fatto con: php artisan make:migration create_roles_users_table)*/
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
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
        Schema::dropIfExists('role_user');
    }
}
