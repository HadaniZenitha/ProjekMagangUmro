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
        Schema::create('sub_jenis_barangs', function (Blueprint $table) {
            $table->id();

        // FK ke Jenis Barang
        $table->foreignId('jenis_barang_id')
              ->constrained('jenis_barangs')
              ->onDelete('cascade');

        $table->string('kode_subjenis', 30)->unique();
        
        $table->string('nama_subjenis', 200);

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
        Schema::dropIfExists('sub_jenis_barangs');
    }
};
