<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Urbanisme\Enums\DossierSourceEnum;
use Urbanisme\Enums\DossierStatutEnum;
use Urbanisme\Enums\DossierTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id('id_dossier');
            $table->string('numero_dossier')->nullable();
            $table->string('objet')->nullable();

            $table->enum('type_dossier', DossierTypeEnum::values())->nullable();
            $table->enum('priorite', ['basse','moyenne','haute'])->nullable();

            $table->enum('source_signalement', DossierSourceEnum::values())->nullable();

            $table->timestamp('date_arrive')->nullable();
            $table->enum('statut', DossierStatutEnum::values())->default(DossierStatutEnum::NOUVEAU->value);

            $table->string('coordonnees_gps')->nullable();
            $table->string('adresse_complete')->nullable();
            $table->text('description_initiale')->nullable();

            $table->unsignedBigInteger('id_utilisateur')->nullable();
            $table->unsignedBigInteger('id_annexe')->nullable();

            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateurs')->onDelete('set null'); // Changed from 'Utilisateur'
            $table->foreign('id_annexe')->references('id_AN')->on('annexes')->onDelete('set null'); // Changed from 'Annexes'

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};
