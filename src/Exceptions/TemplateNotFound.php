<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Exceptions;

use Throwable;

class TemplateNotFound extends \Exception
{
    public $failedTemplate;

    public function __construct(string $failedTemplate, $code = 0, ?Throwable $previous = null)
    {
        $this->failedTemplate = $failedTemplate;

        $message = "Template $failedTemplate not found!";

        parent::__construct($message, $code, $previous);
    }
}
