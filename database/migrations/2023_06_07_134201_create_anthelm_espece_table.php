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
        Schema::create('anthelm_espece', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anthelm_id')->constrained();
            $table->foreignId('espece_id')->constrained();
            $table->set('voie', ['IM', 'SC', 'PO', 'VO'])->nullable();
            $table->string('posologie', 191)->nullable();
            $table->string('lait', 191)->nullable();
            $table->string('viande', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anthelm_espece');
    }
};
