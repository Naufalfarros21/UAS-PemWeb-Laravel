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
        Schema::create('matrix_scores', function (Blueprint $table) {
            $table->id(); // unsignedBigInteger
            $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('cascade');
            $table->int('c1');
            $table->int('c2');
            $table->int('c3');
            $table->int('c4');
            $table->int('c5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matrix_scores');
    }
};