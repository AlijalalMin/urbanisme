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
        Schema::create('mesure_dossier', function (Blueprint $table) {
            $table->id();
            $table->string('action')->nullable();
            $table->string('type_source')->nullable();
            $table->string('niveau_urgence')->nullable();
            $table->string('acteur_responsable')->nullable();
            $table->text('preuve')->nullable();
            $table->text('commentaire')->nullable();
            $table->date('date_execution')->nullable();

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
        Schema::dropIfExists('mesure_dossier');
    }
};
