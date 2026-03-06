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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();

    $table->foreignId('divisi_id')
          ->constrained('divisis')
          ->onDelete('cascade');

    $table->foreignId('ruang_id')
          ->constrained('ruangs')
          ->onDelete('cascade');

    $table->foreignId('sub_jenis_barang_id')
      ->constrained('sub_jenis_barangs')
      ->onDelete('cascade');
      
    $table->foreignId('pic_id')
      ->constrained('pics')
      ->onDelete('cascade');

    $table->string('kode_barang', 50)->unique();

    $table->string('nama_barang');
    $table->string('merk')->nullable();
    $table->string('serial_number')->nullable();
    $table->integer('tahun_perolehan')->nullable();
    $table->text('keterangan')->nullable();
    
    $table->integer('urutan')->default(0);
    
    $table->boolean('is_active')->default(true);
    $table->text('catatan_nonaktif')->nullable();

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
