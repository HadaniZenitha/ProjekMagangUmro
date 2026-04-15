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
        Schema::create('barang_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('barang_id')
                  ->constrained('barangs')
                  ->onDelete('cascade');

            $table->foreignId('ruang_id')
                  ->nullable()
                  ->constrained('ruangs')
                  ->onDelete('set null');
            
            // PIC Lama (Sebelum diubah)
            $table->foreignId('pic_id_lama')
                  ->nullable()
                  ->constrained('pics')
                  ->onDelete('set null');

            // PIC Baru (Setelah diubah)
            $table->foreignId('pic_id_baru')
                  ->nullable()
                  ->constrained('pics')
                  ->onDelete('set null');

            // User yang melakukan perubahan
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            // Data Lain-Lain
            $table->string('kondisi');
            $table->integer('tahun_perolehan')->nullable();
            $table->boolean('is_active');
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_perubahan')->useCurrent();
        
            $table->timestamps();

            // Index untuk mempercepat query history per barang dan per tahun
            $table->index(['barang_id', 'tanggal_perubahan']);
            $table->index('user_id');
            $table->index('pic_id_baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_histories');
    }
};
