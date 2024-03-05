<?php

namespace Gneb\Fee\Helpers;

class File 
{
    public static function checkFileOrExit($file)
    {
        if(is_null($file)){
            echo "file name must be provided" . PHP_EOL;
            exit;
        }
        if(!file_exists($file)){
            echo "file {$file} not found" . PHP_EOL;
            exit;
        }
        return $file;
    }
}