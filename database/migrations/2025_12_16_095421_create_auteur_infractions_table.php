<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Urbanisme\Enums\AuteurInfractionTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auteur_infractions', function (Blueprint $table) {
            $table->id('id_auteur');
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('cin')->nullable();
            $table->enum('statut_professionnel', AuteurInfractionTypeEnum::values())->nullable();
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('raison_sociale')->nullable();
            $table->string('ice')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auteur_infractions');
    }
};
