<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->longText('text');
            $table->integer('user_id')->foreign()->references('id')->on('users')->contrained()->onDelete('cascade'); /* Chiave esterna dell'utente */
            $table->integer('fundraiser_id')->foreign()->references('id')->on('fundraisers')->contrained(1)->onDelete('cascade')->onUpdate('cascade'); /* Chiave esterna della campagna */
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
        Schema::dropIfExists('comments');
    }
}
