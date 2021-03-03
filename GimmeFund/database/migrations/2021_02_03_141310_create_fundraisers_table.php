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
            $table->longText('description'); // descrizione
            $table->date('starting_date'); // data di inizio
            $table->date('ending_date'); // data di fine
            $table->string('filename'); // foto (presa tramite input del form di tipo  upload)
            $table->float('goal', 10, 2); // obbiettivo
            $table->integer('user_id')->foreign()->references('id')->on('users')->contrained()->onDelete('cascade'); // chiave esterna dell'utente che ha aperto la raccolta fondi
            $table->integer('category_id')->foreign()->references('id')->on('categories')->contrained(1)->onDelete('cascade')->onUpdate('cascade'); // chiave esterna della campagna */
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
