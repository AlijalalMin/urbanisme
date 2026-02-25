<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dossier_auteur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dossier');
            $table->unsignedBigInteger('id_auteur');

            $table->string('role_auteur')->nullable();
            $table->text('commentaire')->nullable();

            $table->foreign('id_dossier')->references('id_dossier')->on('dossiers')->onDelete('cascade'); // Changed from 'Dossier'
            $table->foreign('id_auteur')->references('id_auteur')->on('auteur_infractions')->onDelete('cascade'); // Changed from 'AuteurInfraction'

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossier_auteur');
    }
};
