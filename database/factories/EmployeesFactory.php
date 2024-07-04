<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $birth_day = fake()->dateTimeBetween('-35 years', '-20 years')->format('Y-m-d');
        $r = ['male', 'female'];
        $gender = $r[rand(0, 1)];
        $first_name = fake()->firstName($gender);
        $hire_day = fake()->dateTimeBetween('-5 years')->format('Y-m-d');
        $createdAt = $hire_day;
        return [
            //'emp_no' => rand(1, 11),
            'birth_date' => $birth_day,
            'first_name' => $first_name,
            'last_name' => fake()->lastName($gender), // для русской локали
            'gender' => $gender,
            'hire_date' => $hire_day,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
