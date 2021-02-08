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
            $table->string('name');
            $table->longText('description');
            $table->date('starting_date');
            $table->date('ending_date');
            $table->string('media_url');
            $table->float('goal', 10, 2);
            $table->integer('user_id')->foreign()->references('id')->on('users')->contrained()->onDelete('cascade');
            $table->integer('category_id')->foreign()->references('id')->on('categories')->contrained()->onDelete('cascade');
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
