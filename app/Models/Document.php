<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'file_path', 'patient_id', 'processed'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}