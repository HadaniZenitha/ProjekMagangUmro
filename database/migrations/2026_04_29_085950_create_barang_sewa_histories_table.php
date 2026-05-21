<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_sewa_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('barang_sewa_id')
                ->constrained('barang_sewa')
                ->onDelete('cascade');

            $table->foreignId('pic_id_lama')
                ->nullable()
                ->constrained('pics')
                ->nullOnDelete();

            $table->foreignId('pic_id_baru')
                ->nullable()
                ->constrained('pics')
                ->nullOnDelete();

            $table->string('kondisi')->nullable();

            $table->text('catatan')->nullable();

            $table->dateTime('tanggal_perubahan');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_sewa_histories');
    }
};