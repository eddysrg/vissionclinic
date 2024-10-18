<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'doctor' => $this->faker->name(),
            'patient_name' => $this->faker->firstName(),
            'fathers_last_name' => $this->faker->lastName(),
            'mothers_last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['M', 'F']),
            'age' => $this->faker->numberBetween(1, 100),
            'phone_number' => $this->faker->numerify('##########'),
            'curp' => strtoupper($this->faker->bothify('????######??????##')),
            'user_id' => $this->faker->randomElement([1, 2]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
