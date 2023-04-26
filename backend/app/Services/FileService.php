<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileService
{
    private $fileDirectory;

    public $suffix = '';

    const ASSETS_DIRECTORY = 'images';

    public function __construct(string $fileDirectory = '', $addSuffixToFileName = false)
    {
        $this->setFileDirectory($fileDirectory);

        if ($addSuffixToFileName) {
            $this->suffix =  date('Y-m-d_H-i-s') . '_';
        }
    }

    public function setFileDirectory(string $path)
    {
        $this->fileDirectory = self::ASSETS_DIRECTORY . DIRECTORY_SEPARATOR . $path;
    }

    public function getFileDirectory()
    {
        return $this->fileDirectory;
    }

    public function uploadFile(UploadedFile $file)
    {
        $filePath = $this->fileDirectory . '/' . $this->suffix . $file->getClientOriginalName();

        if ($file->move($this->fileDirectory, $this->suffix . $file->getClientOriginalName())) {
            return $filePath;
        }

        return null;
    }
}