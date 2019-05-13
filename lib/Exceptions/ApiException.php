<?php
namespace Ckassa\Exceptions;

use Exception;

class ApiException extends Exception
{
    public function __construct(string $message = "", int $code = 0)
    {
        parent::__construct($code . '. ' . $message, $code);
    }
}