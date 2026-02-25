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
        Schema::create('piece_jointes', function (Blueprint $table) {
            $table->id('id_pj');
            $table->string('nom_fichier')->nullable();
            $table->string('type_mime')->nullable();
            $table->bigInteger('taille_fichier')->nullable();
            $table->string('categorie')->nullable();
            $table->string('chemin_stockage')->nullable();
            $table->timestamp('date_ajout')->nullable();

            $table->unsignedBigInteger('id_dossier')->nullable();
            $table->unsignedBigInteger('id_pv')->nullable();

            $table->foreign('id_dossier')->references('id_dossier')->on('dossiers')->onDelete('cascade'); // Changed from 'Dossier'
            $table->foreign('id_pv')->references('id_Pv')->on('pvs')->onDelete('cascade'); // Changed from 'PV'

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piece_jointes');
    }
};
