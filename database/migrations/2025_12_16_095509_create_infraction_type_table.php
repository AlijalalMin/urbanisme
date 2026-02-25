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
        Schema::create('infraction_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_infraction');
            $table->unsignedBigInteger('id_type');

            $table->integer('niveau_gravite')->nullable();
            $table->text('commentaire')->nullable();
            $table->text('preuve')->nullable();

            $table->foreign('id_infraction')->references('id_infraction')->on('infractions')->onDelete('cascade'); // Changed from 'Infraction'
            $table->foreign('id_type')->references('id_type')->on('type_infractions')->onDelete('cascade'); // Changed from 'TypeInfraction'

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infraction_type');
    }
};
