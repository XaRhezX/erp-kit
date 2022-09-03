<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;
use Image;

trait WithMedia
{
    public function Media()
    {
        return $this->morphOne(Media::class, 'model')->orderBy('updated_at', 'desc');
    }

    public function uploadMedia(UploadedFile $file)
    {
        $path = Storage::path('media') . '/' . $file->getMimeType();
        $mimeType = explode('/', $file->getMimeType());
        $filename = $this->Media()->create([
            'file_name' => md5($file . microtime()) . '.' . $file->extension(),
            'file_name_original' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
            'file_type' => $file->getMimeType()
        ]);
        //dd($image);
        if ($mimeType[0] == 'image') {
            FacadesFile::ensureDirectoryExists($path);
            $img = Image::make($file)->save($path . '/' . $filename->file_name, 30);
        } else {
            $file->storeAs($path, $filename);
        }
    }

    public function uploadBase64Media(string $encodedBase64)
    {
        $base64_str = substr($encodedBase64, strpos($encodedBase64, ",") + 1);
        $fileData = base64_decode($base64_str);
        $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
        file_put_contents($tmpFilePath, $fileData);
        $tmpFile = new File($tmpFilePath);
        $file = new UploadedFile(
            $tmpFile->getPathname(),
            $tmpFile->getFilename(),
            $tmpFile->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );
        $this->uploadMedia($file);
    }
}