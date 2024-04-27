<?

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class FileService
{
    static public function upload(
        UploadedFile $file,
        String $path,
        String $fileName,
        String $prefix = "",
        String $suffix = "",
        String $disk = 'local',
        ?int $imageWidth = null,
        ?int $imageHeight = null,
        int $imageQuality = 100,
        String $imageMimeType = 'png'
    ): false|String {
        if (substr($file->getMimeType(), 0, 5) == 'image') {
            $image = ImageManager::withDriver(new Driver())->read($file);
            $image = $image->resizeDown($imageWidth, $imageHeight);
            $file = $image->encodeByMediaType(
                "image/$imageMimeType",
                progressive: true,
                quality: $imageQuality
            )->__toString();
            $path = "{$path}/{$prefix}_{$fileName}_{$suffix}.{$imageMimeType}";
        } else {
            $path = "{$path}/{$prefix}_{$fileName}_{$suffix}.{$file->getExtension()}";
        }

        return Storage::disk($disk)->put($path, $file) ? $path : false;
    }
}
