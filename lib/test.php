<?php
//require(__DIR__ . '../vendor/autoload.php');
require __DIR__ . '/autoload.php';
use Ckassa\Model\Certificate;
try {
    $cert = new Certificate(__DIR__ . '/test.pem', '');
    print_r($cert->name);
} catch (Exception $e) {
    echo $e->getMessage();
}