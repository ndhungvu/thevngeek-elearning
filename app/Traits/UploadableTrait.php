<?php

namespace App\Traits;

use File;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait UploadableTrait
{
    public function uploadableTimestamp()
    {
        return 'Y/m';
    }

    public function uploadFile(UploadedFile $file, $path = 'image', $uploadDisk = 'uploads')
    {
        $directoryPath = public_path() . '/' . $uploadDisk . '/' . $path;
        $destinationTarget = $this->getFileName($file);

        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0777, true, true);
        }

        $file->move($directoryPath, $directoryPath . '/' . $destinationTarget);

        return $destinationTarget;
    }

    public function destroyFile($destinationTarget, $path = 'image', $uploadDisk = 'uploads')
    {
        $destinationTarget = public_path() . '/' . $uploadDisk . '/' . $path . '/' . $destinationTarget;

        if (File::exists($destinationTarget)) {
            File::delete($destinationTarget);
        }
    }

    public function getFileName(UploadedFile $file)
    {
        return uniqid(time(), true) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
    }

    public function uploadDocument(UploadedFile $file, $path = 'document', $uploadDisk = 'uploads')
    {
        $directoryPath = public_path() . '/' . $uploadDisk . '/' . $path;

        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0777, true, true);
        }

        $fileName = $this->getFileNameDocument($file);
        $destinationTarget = $fileName;
        $pathFile = $directoryPath .  '/' . $fileName;
        $count = 0;

        while (File::exists($pathFile)) {
            $count++;
            $destinationTarget = $count . '-' . $fileName;
            $pathFile = $directoryPath .  '/' . $destinationTarget;
        }

        $file->move($directoryPath, $pathFile);

        return $destinationTarget;
    }

    public function getFileNameDocument(UploadedFile $file)
    {
        $fileName = $file->getClientOriginalName();
        $name = str_slug(pathinfo($fileName, PATHINFO_FILENAME));
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        return $name . '.' . $ext;
    }
}
