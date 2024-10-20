<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'doctor_id', 'date_of_birth', 'phone', 'address'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
