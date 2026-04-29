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
            $table->foreignId('infraction_id')
                ->nullable()
                ->constrained('infractions')
                ->nullOnDelete();
            $table->foreignId('type_id')
                ->nullable()
                ->constrained('type_infractions')
                ->nullOnDelete();

            $table->integer('niveau_gravite')->nullable();
            $table->text('commentaire')->nullable();
            $table->text('preuve')->nullable();

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
