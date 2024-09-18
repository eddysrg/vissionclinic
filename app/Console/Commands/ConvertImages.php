<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConvertImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:images {directory? : The directory to scan for images} {--formats=* : The formats to convert to (avif, webp)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert images to specified formats';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = $this->argument('directory') ?? 'public/images';
        $formats = $this->option('formats');

        if (empty($formats)) {
            $this->error('Please specify at least one format (avif, webp)');
            return Command::FAILURE;
        }

        $files = glob($directory . '/*.*');

        $this->info($files);
    }
}
