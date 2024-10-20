<?php

namespace App\Handlers\Document;

use App\Commands\Document\UploadDocumentCommand;
use App\Jobs\ProcessDocument;
use App\Models\Document;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\CommandBus;

final readonly class UploadDocumentHandler
{
    public function __construct(
        protected CommandBus $commandBus,
    ) {}

    #[CommandHandler]
    public function handle(UploadDocumentCommand $command)
    {
        $filePath = $command->file->storeAs('documents', $command->name, 'public');

        $document = new Document([
            'name' => $command->name,
            'file_path' => $filePath,
            'patient_id' => $command->patientId,
        ]);

        $document->save();

        ProcessDocument::dispatch($document);

        return $document;
    }
}
