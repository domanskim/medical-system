<?php
namespace App\Http\Controllers;

use App\Exceptions\Api\PatientNotFoundException;
use App\Exceptions\Api\RestrictedDataException;
use App\Models\Document;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Jobs\ProcessDocument;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'document' => 'required|mimes:pdf|max:' . (env('MAX_DOCUMENT_SIZE', 5120)),
        ]);

        $this->authorize($patient->doctor_id);

        $file = $request->file('document');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents', $fileName, 'public');

        $document = new Document([
            'name' => $fileName,
            'file_path' => $filePath,
            'patient_id' => $patient->id,
        ]);

        $document->save();

        ProcessDocument::dispatch($document);

        return response()->noContent();
    }

    public function index(Patient $patient)
    {
        $this->authorize($patient->doctor_id);

        return response()->json($patient->documents()->paginate(10));
    }

    public function destroy(Patient $patient, Document $document)
    {
        $this->authorize($patient->doctor_id);

        if ($document->patient_id !== $patient->id) {
            throw new PatientNotFoundException();
        }

        $document->delete();

        return response()->noContent();
    }

    private function authorize(int $doctorId)
    {
        if (Auth::user()->id !== $doctorId) {
            throw new RestrictedDataException();
        }
    }
}
