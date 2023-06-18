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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('troupeau_id')->constrained();
            $table->date('T0');
            $table->date('T1');
            $table->integer('opg0');
            $table->integer('opg1');
            $table->foreignId('anthelm_id')->constrained();
            $table->integer('efficacite');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
