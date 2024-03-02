<?php

namespace Gneb\Fee\Helpers;

class File 
{
    public static function checkFileOrExit($file)
    {
        if(!file_exists($file)){
            echo "file {$file} not found" . PHP_EOL;
            exit;
        }
        return $file;
    }
}