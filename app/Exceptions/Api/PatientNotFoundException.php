<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PatientNotFoundException extends NotFoundHttpException
{
    public function __construct(
        string $message = 'Patient not found',
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $previous);
    }
}
