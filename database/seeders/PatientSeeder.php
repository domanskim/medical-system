<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run()
    {
        Doctor::all()->each(function ($doctor) {
            $patientsCount = rand(5, 15);
            Patient::factory()->count($patientsCount)->create(['doctor_id' => $doctor->id]);
        });
    }
}
