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
        Schema::create('presensi', function (Blueprint $table) {
            $table->uuid('id_presensi')->primary();
            $table->string('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswa');
            $table->date("tgl");
            $table->time('jammasuk')->nullable();
            $table->time('jamkeluar')->nullable();
            $table->time('jamkerja')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('presensi');
    }
};
