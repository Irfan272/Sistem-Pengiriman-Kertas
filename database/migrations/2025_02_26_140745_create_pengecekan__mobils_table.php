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
        Schema::create('pengecekan__mobils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supir_id')->constrained()->cascadeOnDelete();
            $table->string('plat_mobil')->unique();
            $table->date('tanggal_pengecekan');
            $table->string('shift_pengecekan');
            $table->boolean('alarm');
            $table->boolean('lampu_penerangan');
            $table->boolean('lampu_rem');
            $table->boolean('rem');
            $table->boolean('sen_kanan');
            $table->boolean('sen_kiri');
            $table->boolean('klakson');
            $table->boolean('safety_belt');
            $table->string('bukti_video');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengecekan__mobils');
    }
};
