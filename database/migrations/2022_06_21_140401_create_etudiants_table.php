<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('adress');
            $table->string('phone')->unique();
            $table->date('birthdate');
            $table->string('profil');
            $table->unsignedBigInteger('userId')->unique();
            $table->unsignedBigInteger('villeId');
            $table->foreign ('userId') -> references ('id') -> on ('users');
            $table->foreign ('villeId') -> references ('id') -> on ('villes');
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
        Schema::dropIfExists('etudiants');
    }
}
