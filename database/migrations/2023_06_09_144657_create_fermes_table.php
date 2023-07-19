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
        Schema::create('fermes', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 191);
            $table->foreignId('user_id')->constrained()->nullable()->default(null);
            $table->unsignedInteger('ede')->default(null);
            $table->boolean('isBio')->default(false);
            $table->string('adresse', 191)->nullable();
            $table->foreignId('commune_id')->constrained();
            $table->decimal('latitude', 8, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->foreignId('eleveur_id')->constrained(
                table: 'users', indexName: 'id'
            );
            $table->foreignId('veto_id')->constrained(
                table: 'users', indexName: 'id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fermes');
    }
};
