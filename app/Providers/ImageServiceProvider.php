<?php

namespace App\Providers;

// use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
// use Intervention\Image\ImageManager;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->singleton(Connection::class, function (Application $app) {
        //     return new Connection(config('riak'));
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    // public static function upload(
    //     $file,
    //     $filePath,
    //     $fileName,
    //     $disk = config('filesystems.default'),
    //     $width = null,
    //     $height = null,
    //     $fileExtension = 'png',
    //     $prefix = '',
    //     $suffix = '',
    //     $fullView = true,
    //     $quality = 100
    // ): bool|string {
    //     $mimeType = $file->getClientMimeType();
    //     $mimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];

    //     $manager = ImageManager::gd();


    //     return isset($stored) ? $fileName : false;
    // }
}
