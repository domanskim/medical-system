<?php

namespace App\Http\Controllers\Document;

use App\Exceptions\Api\RestrictedDataException;
use Illuminate\Support\Facades\Auth;

trait AuthorizeDoctor
{

    private function authorize(int $doctorId)
    {
        if (Auth::user()->id !== $doctorId) {
            throw new RestrictedDataException();
        }
    }
}
