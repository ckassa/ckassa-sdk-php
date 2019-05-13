<?php
namespace Ckassa\Exceptions;

use Exception;

class ConnectionException extends Exception
{
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}