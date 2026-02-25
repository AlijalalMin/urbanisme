<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Urbanisme\Enums\PvTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pvs', function (Blueprint $table) {
            $table->id('id_Pv');
            $table->string('numero_pv')->nullable();
            $table->string('source')->nullable();
            $table->timestamp('date_pv')->nullable();
            $table->string('lieu')->nullable();
            $table->enum('typePV', PvTypeEnum::values())->nullable();
            $table->text('observation')->nullable();
            $table->string('statut')->nullable();

            $table->unsignedBigInteger('id_dossier')->nullable();
            $table->unsignedBigInteger('redacteur')->nullable();

            $table->foreign('id_dossier')->references('id_dossier')->on('dossiers')->onDelete('cascade'); // Changed from 'Dossier'
            $table->foreign('redacteur')->references('id_utilisateur')->on('utilisateurs')->onDelete('set null'); // Changed from 'Utilisateur'

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pvs');
    }
};
