<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function render($request, \Throwable $e)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }

        return parent::render($request, $e);
    }

}
