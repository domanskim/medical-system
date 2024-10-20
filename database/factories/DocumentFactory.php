<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true) . '.pdf',
            'file_path' => 'documents/' . $this->faker->md5 . '.pdf',
            'patient_id' => Patient::factory(),
            'processed' => false,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
