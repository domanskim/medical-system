<?php

namespace App\Http\Controllers\Document;

use App\Commands\Document\UploadDocumentCommand;
use App\Http\Controllers\BaseCommandAction;
use App\Http\Requests\UploadDocumentRequest;
use App\Models\Patient;

class UploadDocument extends BaseCommandAction
{
    use AuthorizeDoctor;

    public function __invoke(UploadDocumentRequest $request, Patient $patient)
    {
        $this->authorize($patient->doctor_id);

        $file = $request->file('document');
        $command = new UploadDocumentCommand(
            $patient->id,
            $file,
            time() . '_' . $file->getClientOriginalName()
        );

        $this->commandBus->send($command);

        return response()->noContent();
    }

}
