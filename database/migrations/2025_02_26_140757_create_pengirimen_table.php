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
        Schema::create('pengirimen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supir_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pengecekan_mobil_id')->constrained()->cascadeOnDelete();
            $table->string('shift');
            $table->integer('total_tonase');
            $table->integer('total_ritase');
            $table->date('tanggal_pengiriman');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->foreignId('user_1')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('status_approval_1')->nullable();
            $table->string('remaks_1')->nullable();
            $table->foreignId('user_2')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('status_approval_2')->nullable();
            $table->string('remaks_2')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimen');
    }
};
