<?php
namespace Ckassa\Exceptions;

use Exception;

class ConnectionException extends Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message);
    }
}