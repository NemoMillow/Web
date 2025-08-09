<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, drop the existing enum constraint
        DB::statement("ALTER TABLE halaman MODIFY COLUMN jenis ENUM('beranda', 'profil', 'sejarah', 'kepala_uptd', 'visi_misi', 'tujuan', 'identitas') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to the original enum values
        DB::statement("ALTER TABLE halaman MODIFY COLUMN jenis ENUM('profil', 'sejarah', 'kepala_uptd', 'visi_misi', 'tujuan', 'identitas') NOT NULL");
    }
};
