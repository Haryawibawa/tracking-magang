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
        Schema::create('masa_magang', function (Blueprint $table) {
            $table->uuid('id_masa_magang')->primary();
            $table->string('startdate');
            $table->string('enddate');
            $table->boolean('status')->default(true);
            $table->string('nim')->nullable();
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('set null');
            $table->string('id_spv')->nullable();
            $table->foreign('id_spv')->references('id_spv')->on('supervisi')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masa_magang');
    }
};
