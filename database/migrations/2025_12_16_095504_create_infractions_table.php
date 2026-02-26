<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\InfractionStatutEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('infractions', function (Blueprint $table) {
            $table->id();
            $table->string('numero_infraction')->nullable();
            $table->timestamp('date_constatation')->nullable();
            $table->string('localisation_precise')->nullable();
            $table->integer('niveau_gravite')->nullable();
            $table->enum('statut_infraction', InfractionStatutEnum::values())->nullable();

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
        Schema::dropIfExists('infractions');
    }
};
