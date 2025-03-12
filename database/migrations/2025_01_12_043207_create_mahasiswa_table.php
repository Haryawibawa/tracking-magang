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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim', 32)->primary();
            $table->string('id_spv')->nullable();
            $table->foreign('id_spv')->references('id_spv')->on('supervisi')->onDelete('set null');
            $table->string('namamhs', 255);
            $table->string('alamatmhs', 255)->nullable();
            $table->string('emailmhs', 255);
            $table->string('nohpmhs', 15)->nullable();
            $table->string('jeniskelamin', 255)->nullable();
            $table->string('agama', 255)->nullable();
            $table->string('tempatlahirmhs', 255)->nullable();
            $table->date('tanggallahirmhs')->nullable();
            $table->string('posisi', 100)->nullable();
            $table->string('namauniv', 100)->nullable();
            $table->string('fakultas', 100)->nullable();
            $table->string('jurusan', 100)->nullable();
            $table->string('foto', 255)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
