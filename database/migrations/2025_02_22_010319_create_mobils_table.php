<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('plat_mobil')->unique();
            $table->string('merk');
            $table->string('tipe')->nullable();
            $table->string('warna')->nullable();
            $table->year('tahun')->nullable();
            $table->string('status')->default('aktif'); // aktif / tidak aktif / rusak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
