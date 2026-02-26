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
        Schema::create('dossier_requerant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dossier_id')
                    ->nullable()
                    ->constrained('dossiers')
                    ->nullOnDelete();
            $table->foreignId('requerant_id')
                    ->nullable()
                    ->constrained('requerants')
                    ->nullOnDelete();

            $table->string('role')->nullable();
            $table->text('commentaire')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossier_requerant');
    }
};
