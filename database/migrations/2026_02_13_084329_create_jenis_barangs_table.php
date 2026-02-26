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
        Schema::create('jenis_barangs', function (Blueprint $table) {
            $table->id();

        // FK ke Kelompok Barang
        $table->foreignId('kelompok_barang_id')
              ->constrained('kelompok_barangs')
              ->onDelete('cascade');

        // $table->string('kode_jenis', 20)->unique();
        $table->string('kode_jenis', 10)->unique();
        // $table->unique(['kelompok_barang_id', 'kode_jenis']);

        $table->string('nama_jenis', 200);

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
        Schema::dropIfExists('jenis_barangs');
    }
};
