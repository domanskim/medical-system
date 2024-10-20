<?php

namespace App\Http\Controllers\Document;

use App\Commands\Document\DeleteDocumentCommand;
use App\Exceptions\Api\PatientNotFoundException;
use App\Http\Controllers\BaseCommandAction;
use App\Models\Document;
use App\Models\Patient;

class DeleteDocument extends BaseCommandAction
{

    use AuthorizeDoctor;

    public function __invoke(Patient $patient, Document $document)
    {
        $this->authorize($patient->doctor_id);

        if ($document->patient_id !== $patient->id) {
            throw new PatientNotFoundException();
        }

        $this->commandBus->send(new DeleteDocumentCommand($document->id));

        return response()->noContent();

    }

}
