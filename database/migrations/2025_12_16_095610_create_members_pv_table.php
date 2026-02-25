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
        Schema::create('members_pv', function (Blueprint $table) {
            $table->id('id_mp');
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('role')->nullable();

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
        Schema::dropIfExists('members_pv');
    }
};
