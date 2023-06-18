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
        Schema::create('troupeaus', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 191);
            $table->foreignId('ferme_id')->constrained();
            $table->foreignId('espece_id')->constrained();
            $table->foreignId('production_id')->constrained();
            $table->unsignedInteger('effectif')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('troupeaus');
    }
};
