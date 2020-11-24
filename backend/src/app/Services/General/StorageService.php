<?php

namespace App\Services\General;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;

class StorageService
{
    private $storage;

    public function __construct()
    {
        $this->storage = Storage::disk(env('FILESYSTEM_DRIVER'));
    }

    public function upload(UploadedFile $file, $path = "/")
    {
        return $this->storage->put($path, $file);
    }

    public function delete(string $path)
    {
        $this->storage->delete($path);
    }

    public function exists(string $path)
    {
        return $this->storage->exists($path);
    }

    public function getURL(string $path)
    {
        return $this->storage->url($path);
    }

    public function convertBase64ToFileUploaded(string $document) : UploadedFile
    {
        if (preg_match('/\w+;base64,/', $document)) {
            $document = substr($document, strpos($document, ',') + 1);
        }

        $document = base64_decode($document);
        $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
        file_put_contents($tmpFilePath, $document);

        $tmpFile = new File($tmpFilePath);

        return new UploadedFile(
            $tmpFile->getPathname(),
            $tmpFile->getFilename(),
            $tmpFile->getMimeType()
        );
    }
}
