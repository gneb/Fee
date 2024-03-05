<?php

namespace Gneb\Fee;

class Config
{
    public static function get(string $name)
    {
        global $ENV;
        $target = $ENV[$name];
        if(!isset($target)){
            echo "config {$name} does not exists";
            exit;
        }
        return $target;
    }
}