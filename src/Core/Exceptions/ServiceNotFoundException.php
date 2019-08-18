<?php


namespace Castels\Core\Exceptions;


use Exception;
use Throwable;

class ServiceNotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}