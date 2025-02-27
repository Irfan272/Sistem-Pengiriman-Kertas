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
        Schema::create('pengiriman__details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengiriman_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kertas_id')->constrained()->cascadeOnDelete();
            $table->integer('tonase_kg');
            $table->integer('ritase');
            $table->string('lokasi');
            $table->string('approval_1');
            $table->string('approval_2');
            $table->string('remaks_1');
            $table->string('remaks_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman__details');
    }
};
