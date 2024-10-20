<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password'];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
