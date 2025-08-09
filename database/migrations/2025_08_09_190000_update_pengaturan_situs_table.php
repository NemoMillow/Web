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
        Schema::table('pengaturan_situs', function (Blueprint $table) {
            // Rename columns to match our model
            $table->renameColumn('nama_site', 'nama_situs');
            $table->renameColumn('deskripsi_site', 'deskripsi_situs');
            
            // Add missing columns
            $table->string('tagline')->after('nama_situs')->nullable();
            $table->string('meta_title')->after('maps_embed')->nullable();
            $table->text('meta_description')->after('meta_title')->nullable();
            $table->text('meta_keywords')->after('meta_description')->nullable();
            $table->string('meta_image')->after('meta_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan_situs', function (Blueprint $table) {
            // Reverse the renames
            $table->renameColumn('nama_situs', 'nama_site');
            $table->renameColumn('deskripsi_situs', 'deskripsi_site');
            
            // Drop the added columns
            $table->dropColumn([
                'tagline',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'meta_image',
            ]);
        });
    }
};
