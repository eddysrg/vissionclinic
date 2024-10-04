<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class ConvertToWebpAvif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:convert-webp-avif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert all JPG and PNG images in public/images to WebP and AVIF';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // Definir ruta de imágenes
        $imagePath = public_path('images');

        // Crear instancia de ImageManager con Imagick
        $manager = new ImageManager(new Driver());

        // Buscar todos los archivos JPG y PNG en el directorio
        $images = File::allFiles($imagePath);
        foreach ($images as $image) {
            if (in_array($image->getExtension(), ['jpg', 'jpeg', 'png'])) {
                // Leer imagen
                $img = $manager->read($image->getPathname());

                // Convertir a WebP
                $webpPath = $imagePath . '/' . $image->getFilenameWithoutExtension() . '.webp';
                $webpData = $img->toWebp(80); // 80 es la calidad
                file_put_contents($webpPath, $webpData);

                // Convertir a AVIF
                $avifPath = $imagePath . '/' . $image->getFilenameWithoutExtension() . '.avif';
                $avifData = $img->toAvif(80); // 80 es la calidad
                file_put_contents($avifPath, $avifData);

                $this->info("Convertido {$image->getFilename()} a WebP y AVIF.");
            }
        }
        $this->info('Conversión completada.');
    }
}
