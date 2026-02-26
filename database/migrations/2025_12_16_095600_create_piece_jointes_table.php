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
            $table->id();
            $table->string('nom_fichier')->nullable();
            $table->string('type_mime')->nullable();
            $table->bigInteger('taille_fichier')->nullable();
            $table->string('categorie')->nullable();
            $table->string('chemin_stockage')->nullable();
            $table->timestamp('date_ajout')->nullable();

            $table->foreignId('dossier_id')
                    ->nullable()
                    ->constrained('dossiers')
                    ->nullOnDelete();
            $table->foreignId('pv_id')
                    ->nullable()
                    ->constrained('pvs')
                    ->nullOnDelete();

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
