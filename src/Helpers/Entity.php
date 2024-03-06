<?php

declare(strict_types=1);

namespace Gneb\Fee\Helpers;

class Entity
{
    public static function checkClassOrExit($class)
    {
        if (!class_exists($class)) {
            echo "class {$class} not found".PHP_EOL;
            exit;
        }

        return $class;
    }
}
