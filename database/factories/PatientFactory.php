<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'doctor_id' => Doctor::factory(),
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
        ];
    }
}
