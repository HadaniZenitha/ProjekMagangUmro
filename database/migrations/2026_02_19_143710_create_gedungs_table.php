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
        Schema::create('gedungs', function (Blueprint $table) {
            $table->id();

            // contoh: SB, GB-A, TOWER1
            $table->string('kode_gedung', 20)->unique();

            // contoh: Smart Building
            $table->string('nama_gedung', 150);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gedungs');
    }
};
