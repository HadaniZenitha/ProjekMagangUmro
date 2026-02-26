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
        Schema::create('lantais', function (Blueprint $table) {
            $table->id();

        // FK ke Gedung
        $table->foreignId('gedung_id')
              ->constrained('gedungs')
              ->onDelete('cascade');

        // kode fleksibel: L1, L1.5, Basement
        $table->string('kode_lantai', 20);

        // nama opsional: "Lantai 1 Tengah"
        $table->string('nama_lantai', 100)->nullable();

        $table->boolean('is_active')->default(true);

        $table->timestamps();

        // Supaya tidak ada duplikat lantai dalam gedung yang sama
        $table->unique(['gedung_id', 'kode_lantai']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lantais');
    }
};
