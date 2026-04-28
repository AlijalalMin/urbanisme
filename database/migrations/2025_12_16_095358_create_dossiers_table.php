<?php

use App\Enums\DossierSourceEnum;
use App\Enums\DossierStatutEnum;
use App\Enums\DossierTypeEnum;
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
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id();
            $table->string('numero_dossier')->nullable();
            $table->string('objet')->nullable();

            $table->enum('type_dossier', DossierTypeEnum::values())->nullable();
            $table->enum('priorite', ['basse', 'moyenne', 'haute'])->nullable();

            $table->enum('source_signalement', DossierSourceEnum::values())->nullable();

            $table->timestamp('date_arrive')->nullable();
            $table->enum('statut', DossierStatutEnum::values())->default(DossierStatutEnum::NOUVEAU->value);

            $table->string('coordonnees_gps')->nullable();
            $table->string('adresse_complete')->nullable();
            $table->text('description_initiale')->nullable();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('annexe_id')
                ->nullable()
                ->constrained('annexes')
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
        Schema::dropIfExists('dossiers');
    }
};
