<?php

namespace App\Commands\Document;

use App\Http\Requests\UploadDocumentRequest;
use Illuminate\Http\UploadedFile;

class UploadDocumentCommand
{

    public function __construct(
        public readonly string       $patientId,
        public readonly UploadedFile $file,
        public readonly string       $name
    ) {}

}
