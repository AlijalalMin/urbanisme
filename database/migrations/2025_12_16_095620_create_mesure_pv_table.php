<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Urbanisme\Enums\MesureTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mesure_pv', function (Blueprint $table) {
            $table->id('id_MPv');
            $table->timestamp('date_rappel')->nullable();
            $table->enum('typeMesure', MesureTypeEnum::values())->nullable();
            $table->float('cout_estimatif')->nullable();
            $table->string('pilote_mesure')->nullable();
            $table->text('commentaire')->nullable();
            $table->text('preuve')->nullable();

            $table->unsignedBigInteger('id_P')->nullable();
            $table->foreign('id_P')->references('id_Pv')->on('pvs')->onDelete('cascade'); // Changed from 'PV'

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesure_pv');
    }
};
