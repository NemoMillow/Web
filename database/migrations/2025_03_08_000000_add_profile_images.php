<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AddProfileImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create images directory if it doesn't exist
        $imageDir = public_path('img');
        if (!File::exists($imageDir)) {
            File::makeDirectory($imageDir, 0755, true);
        }

        // List of required images and their sources
        $images = [
            'avatar-placeholder.png' => 'https://ui-avatars.com/api/?name=TBA&background=1a56db&color=fff&size=150',
            'logo-tba.png' => 'https://via.placeholder.com/200x200?text=Logo+TBA',
            'noprofile.jpg' => 'https://ui-avatars.com/api/?name=Kepala+UPTD&background=1a56db&color=fff&size=600',
            'gelumbangraya.jpg' => 'https://images.unsplash.com/photo-1588666309990-0f3b6adc03b1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80',
            'panoptycon.jpg' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80'
        ];

        // Download and save each image
        foreach ($images as $filename => $url) {
            $path = $imageDir . '/' . $filename;
            if (!file_exists($path)) {
                try {
                    $content = file_get_contents($url);
                    file_put_contents($path, $content);
                } catch (\Exception $e) {
                    // Log error but don't stop execution
                    \Log::error("Failed to download image {$filename}: " . $e->getMessage());
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Optionally remove the images when rolling back
        // Be careful with this in production
        /*
        $images = [
            'avatar-placeholder.png',
            'logo-tba.png',
            'noprofile.jpg',
            'gelumbangraya.jpg',
            'panoptycon.jpg'
        ];

        foreach ($images as $filename) {
            $path = public_path('img/' . $filename);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        */
    }
}
