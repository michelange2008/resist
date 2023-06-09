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
        Schema::create('anthelm_molecule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anthelm_id')->constrained();
            $table->foreignId('molecule_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anthelm_molecule');
    }
};
