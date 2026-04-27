<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_sewa', function (Blueprint $table) {
            $table->id();

            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('divisi_id')->nullable();

            $table->foreignId('pic_id')
                ->constrained('pics')
                ->cascadeOnDelete();

            $table->foreignId('ruang_id')
                ->constrained('ruangs')
                ->cascadeOnDelete();

            $table->year('tahun');

            $table->enum('kondisi', [
                'Baik',
                'Perlu Perbaikan',
                'Rusak'
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_sewa');
    }
};