<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {{{  }}
            $table->id();
            $table->date('date');
            $table->float('amount');
            $table->integer('user_id')->foreign()->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->integer('fundraiser_id')->foreign()->references('id')->on('fundraisers')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('donations');
    }
}
