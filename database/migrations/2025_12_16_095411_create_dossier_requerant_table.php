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
            $table->unsignedBigInteger('id_dossier');
            $table->unsignedBigInteger('id_requerant');

            $table->string('role')->nullable();
            $table->text('commentaire')->nullable();

            $table->foreign('id_dossier')->references('id_dossier')->on('dossiers')->onDelete('cascade'); // Changed from 'Dossier'
            $table->foreign('id_requerant')->references('id_requerant')->on('requerants')->onDelete('cascade'); // Changed from 'Requerant'

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
