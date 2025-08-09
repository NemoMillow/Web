<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateSiteName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:site-name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all instances of "UPTD. Taman Seni dan Budaya Aceh" to "UPTD. Taman Seni dan Budaya Aceh"';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $directories = [
            app_path(),
            resource_path('views'),
            config_path(),
            base_path('routes'),
            base_path('database'),
        ];

        $extensions = ['php', 'md', 'json', 'blade.php'];
        $search = 'UPTD. Taman Seni dan Budaya Aceh';
        $replace = 'UPTD. Taman Seni dan Budaya Aceh';
        $count = 0;

        foreach ($directories as $directory) {
            if (!File::exists($directory)) {
                continue;
            }

            $files = File::allFiles($directory);
            
            foreach ($files as $file) {
                if (in_array($file->getExtension(), $extensions) || 
                    in_array($file->getFilename(), ['composer.json', 'package.json'])) {
                    
                    $content = File::get($file->getPathname());
                    
                    if (strpos($content, $search) !== false) {
                        $newContent = str_replace($search, $replace, $content, $replaced);
                        if ($replaced > 0) {
                            File::put($file->getPathname(), $newContent);
                            $count += $replaced;
                            $this->info("Updated: " . $file->getRelativePathname() . " ($replaced occurrences)");
                        }
                    }
                }
            }
        }

        $this->info("\nUpdate complete! Total replacements made: $count");
        return 0;
    }
}
