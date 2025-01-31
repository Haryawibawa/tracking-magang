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
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn(['namauniv', 'fakultas', 'jurusan']);

            // Tambah kolom baru dengan foreign key
            $table->string('id_univ')->nullable();
            $table->foreign('id_univ')->references('id_univ')->on('universitas')->onDelete('set null');

            $table->string('id_fakultas')->nullable();
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('set null');

            $table->string('id_jurusan')->nullable();
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {

        });
    }
};
