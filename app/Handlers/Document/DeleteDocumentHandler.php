<?php

namespace App\Handlers\Document;

use App\Commands\Document\DeleteDocumentCommand;
use App\Models\Document;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\CommandBus;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class DeleteDocumentHandler
{

    public function __construct(
        protected CommandBus $commandBus,
    ) {}

    #[CommandHandler]
    public function handle(DeleteDocumentCommand $command): bool
    {
        $document = Document::find($command->id);

        if (!$document) {
            throw new NotFoundHttpException();
        }

        return $document->delete();
    }

}
