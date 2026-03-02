<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DossierSourceEnum;
use App\Enums\DossierStatutEnum;
use App\Enums\DossierTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dossiers', function (Blueprint $table) {
            // Add missing columns
            $table->string('plaignant')->nullable()->after('source_signalement');
            $table->string('accuse')->nullable()->after('plaignant');

            // Correct Enum values or change to string for flexibility
            $table->string('source_signalement')->nullable()->change();
            $table->enum('priorite', ['faible', 'normale', 'haute'])->nullable()->change();
            
            // Re-apply updated Enums
            $table->enum('type_dossier', DossierTypeEnum::values())->nullable()->change();
            $table->enum('statut', DossierStatutEnum::values())->default(DossierStatutEnum::NOUVEAU->value)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dossiers', function (Blueprint $table) {
            $table->dropColumn(['plaignant', 'accuse']);
            
            // Reverting enums is complex and might lose data if types were changed
            // but for simplicity in development:
            $table->enum('priorite', ['basse', 'moyenne', 'haute'])->nullable()->change();
        });
    }
};
