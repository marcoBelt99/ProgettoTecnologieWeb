<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundraisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundraisers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nome della raccolta fondi
            $table->string('summary');
            $table->longText('description'); // descrizione
            $table->date('starting_date'); // data di inizio
            $table->date('ending_date'); // data di fine
            $table->string('media_url'); // foto (presa tramite l'url)
            $table->float('goal', 10, 2); // obbiettivo --> lo uso per fare la navbar
            $table->integer('user_id')->foreign()->references('id')->on('users')->contrained()->onDelete('cascade'); // chiave esterna dell'utente che ha aperto la raccolta fondi
            $table->integer('category_id')->foreign()->references('id')->on('categories')->contrained()->onDelete('cascade'); // chiave esterna della categoria
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
        // Elimina la tabella se esiste
        Schema::dropIfExists('fundraisers');
    }
}
