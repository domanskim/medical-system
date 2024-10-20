<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document' => 'required|mimes:pdf|max:' . (env('MAX_DOCUMENT_SIZE', 5120)),
        ];
    }

}
