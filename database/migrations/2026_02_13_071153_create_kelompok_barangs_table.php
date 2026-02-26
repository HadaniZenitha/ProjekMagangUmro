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
        Schema::create('kelompok_barangs', function (Blueprint $table) {
            $table->id();

            $table->string('kode_kelompok', 10)->unique();
            $table->string('nama_kelompok', 200);

            $table->text('deskripsi')->nullable();

            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_barangs');
    }
};
