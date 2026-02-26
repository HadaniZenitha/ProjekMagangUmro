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
        Schema::create('jenis_ruangans', function (Blueprint $table) {
            $table->id();

            // contoh: TL, KTR, LAB
            $table->string('kode_jenis_ruangan', 20)->unique();

            // contoh: Toilet, Kantor
            $table->string('nama_jenis_ruangan', 150);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_ruangans');
    }
};
