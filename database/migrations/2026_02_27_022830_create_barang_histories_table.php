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
        
            $table->boolean('is_active');
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_perubahan');
        
            $table->timestamps();
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
