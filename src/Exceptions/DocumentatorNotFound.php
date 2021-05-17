<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Exceptions;

use Throwable;

class DocumentatorNotFound extends \Exception
{
    public function __construct(string $ext, $code = 0, Throwable $previous = null)
    {
        $message = "Documentator '$ext' not found!";

        parent::__construct($message, $code, $previous);
    }
}
