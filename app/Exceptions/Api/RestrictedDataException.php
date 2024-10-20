<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Throwable;

class RestrictedDataException extends BadRequestHttpException
{

    public function __construct(
        string $message = 'Restricted data',
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $previous);
    }

}
