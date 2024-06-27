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
        Schema::create('seleksi', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('kode', 10);
            $table->decimal('C1', 8, 2);
            $table->decimal('C2', 8, 2);
            $table->decimal('C3', 8, 2);
            $table->decimal('C4', 8, 2);
            $table->decimal('C5', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seleksi');
    }
};