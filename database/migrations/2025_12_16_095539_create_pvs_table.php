<?php

use App\Enums\PvTypeEnum;
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
        Schema::create('pvs', function (Blueprint $table) {
            $table->id();
            $table->string('numero_pv')->nullable();
            $table->string('source')->nullable();
            $table->timestamp('date_pv')->nullable();
            $table->string('lieu')->nullable();
            $table->enum('typePV', PvTypeEnum::values())->nullable();
            $table->text('observation')->nullable();
            $table->string('statut')->nullable();

            $table->foreignId('dossier_id')
                ->nullable()
                ->constrained('dossiers')
                ->nullOnDelete();

            $table->foreignId('redacteur_id')
                ->nullable()
                ->constrained('users')
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
        Schema::dropIfExists('pvs');
    }
};
