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
            $table->foreignId('voie_id')->constrained();
            $table->foreignId('unite')->constrained();
            $table->float('posologie', 8, 2);
            $table->float('lait', 8, 2);
            $table->float('viande', 8, 2);
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
