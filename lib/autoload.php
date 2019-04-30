<?php
function autoloader($className)
{
    $path   = dirname(__FILE__);
    $length = 6;
    $path .= str_replace('\\', '/', substr($className, $length)) . '.php';
    if (file_exists($path)) {
        require $path;
    }
}

spl_autoload_register('autoloader');