<?php

namespace App\Http\Controllers\Document;

use App\Models\Patient;
use Illuminate\Http\Request;

class GetDocumentsListQuery
{
    use AuthorizeDoctor;

    public function __invoke(Request $request, Patient $patient)
    {
        $this->authorize($patient->doctor_id);

        return response()->json($patient->documents()->paginate(10));
    }

}
