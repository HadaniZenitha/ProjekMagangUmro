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
        Schema::create('ruangs', function (Blueprint $table) {
            $table->id();

            // FK ke Lantai (Gedung → Lantai → Ruang)
            $table->foreignId('lantai_id')
                  ->constrained('lantais')
                  ->onDelete('cascade');

            // FK ke Jenis Ruangan
            $table->foreignId('jenis_ruangan_id')
                  ->constrained('jenis_ruangans')
                  ->onDelete('cascade');

            // Kode ruang otomatis (unique)
            $table->string('kode_ruang', 30)->unique();

            // Nama ruang
            $table->string('nama_ruang', 150);

            // PIC opsional
            $table->string('pic_nama')->nullable();

            // Untuk generator kode otomatis
            $table->integer('urutan')->default(0);

            // Status aktif/nonaktif
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Supaya tidak ada ruang duplikat dalam lantai+jenis yang sama
            $table->unique(['lantai_id', 'jenis_ruangan_id', 'urutan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangs');
    }
};
