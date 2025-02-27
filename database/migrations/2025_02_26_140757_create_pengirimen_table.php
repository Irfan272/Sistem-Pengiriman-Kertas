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
            $table->string('shift');
            $table->integer('total_tonase');
            $table->integer('total_ritase');
            $table->date('tanggal_pengiriman');
            $table->timestamp('jam_masuk');
            $table->timestamp('jam_keluar');
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
