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
        Schema::create('reponse_autorite', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date_reponse')->nullable();
            $table->text('compte_rendu')->nullable();
            $table->string('decision_finale')->nullable();
            $table->string('autorite_responsable')->nullable();
            $table->string('fichier_pv')->nullable();

            $table->foreignId('dossier_id')
                ->nullable()
                ->constrained('dossiers')
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
        Schema::dropIfExists('reponse_autorite');
    }
};
