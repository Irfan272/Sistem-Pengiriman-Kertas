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
        Schema::create('pengecekan_mobils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supir_id')->constrained()->cascadeOnDelete();
            $table->string('plat_mobil')->unique();
            $table->date('tanggal_pengecekan');
            $table->string('shift_pengecekan');
            $table->integer('alarm');
            $table->integer('lampu_penerangan');
            $table->integer('lampu_rem');
            $table->integer('rem');
            $table->integer('sen_kanan');
            $table->integer('sen_kiri');
            $table->integer('klakson');
            $table->integer('safety_belt');
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
        Schema::dropIfExists('pengecekan_mobils');
    }
};
