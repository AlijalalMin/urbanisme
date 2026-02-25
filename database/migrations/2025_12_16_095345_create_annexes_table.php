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
        Schema::create('annexes', function (Blueprint $table) {
            $table->id('id_AN');
            $table->string('nom')->nullable();
            $table->unsignedBigInteger('id_district')->nullable();
            $table->foreign('id_district')->references('id_Dist')->on('districts')->onDelete('set null'); // Changed from 'District'
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annexes');
    }
};
