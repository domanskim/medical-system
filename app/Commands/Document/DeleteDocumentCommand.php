<?php

namespace App\Commands\Document;

class DeleteDocumentCommand
{

    public function __construct(
        public readonly int $id
    ) {}

}
