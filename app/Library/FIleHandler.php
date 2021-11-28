<?php

namespace App\Library;

use Illuminate\Support\Facades\Storage;

class FIleHandler
{
    /**
     *
     * @param
     *     @file string
     *
     *  @return string
     *
     */
    public static function uploadFiles($file)
    {
        $filenameWithExt = $file->getClientOriginalName();
        $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension       = $file->getClientOriginalExtension();
        $fileNameToStore = $filename . '_' . hexdec(uniqid()) . '.' . $extension;
        $path            = Storage::disk('public')->put('images/' . $fileNameToStore, fopen($file, 'r+'));
        $url             = 'storage/images/' . $fileNameToStore . '';

        return $url;
    }

    /**
     *
     * @param
     *     @file string
     *
     *  @return
     *
     */
    public static function getFileBaseName($file)
    {
        $fileName = explode('/', $file)[2];
        $file     = empty($fileName) ? '' : $fileName;
        if ($file != '') {
            self::deleteFromStorage($file);
        }

        return $fileName;
    }

    /**
     *
     * @param
     *     @fileName string
     *
     *  @return boolean
     *
     */
    public static function deleteFromStorage($fileName)
    {
        Storage::delete('images/', $fileName);
    }

    public static function deleteFile($file)
    {
        $fileName = explode('/', $file)[2];
        if (!empty($fileName)) {
            $sls = Storage::delete('public/images/' . $fileName);
        }
    }
}
