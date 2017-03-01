<?php
/**
 * Created by PhpStorm.
 * User: kevingates
 * Date: 12/2/16
 * Time: 11:08 AM
 */
namespace App\Helpers;
use Config;
use ZipArchive;

class ZipArchiveHelper
{
    public static function extractCoverImage($epubfile, $coverImagePath)
    {
        if (!file_exists($coverImagePath)) {
            mkdir($coverImagePath, 0777, true);
        }
        $zip = new ZipArchive;
        if ($zip->open($epubfile) === TRUE) {
            $zip->extractTo($coverImagePath, array('cover.jpeg'));
            $zip->close();
            return true;
        } else {
            return false;
        }
        unset($zip);
    }
}