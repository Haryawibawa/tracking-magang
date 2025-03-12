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
        Schema::table('supervisi', function (Blueprint $table) {
            $table->dropForeign(['nim']);
            $table->dropColumn('nim');

            // Tambahkan kolom 'pangkat'
            $table->string('pangkat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supervisi', function (Blueprint $table) {
            // Tambahkan kembali kolom 'nim'
            $table->string('nim')->nullable();
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('set null');

            // Hapus kolom 'pangkat' jika rollback
            $table->dropColumn('pangkat');
        });
    }
};
