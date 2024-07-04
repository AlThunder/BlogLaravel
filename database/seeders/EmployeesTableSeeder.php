<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count_rec = 300000;
        $employees = [];

        for ($i = 1; $i <= $count_rec; $i++) {
            $birth_day = fake()->dateTimeBetween('-35 years', '-20 years')->format('Y-m-d');
            $r = ['male', 'female'];
            $gender = $r[rand(0, 1)];
            $first_name = fake()->firstName($gender);
            $gender = strtoupper($gender[0]);
            $hire_day = fake()->dateTimeBetween('-5 years')->format('Y-m-d');
            $createdAt = $hire_day;

            $employees[] =
                [
                    'birth_date' => $birth_day,
                    'first_name' => $first_name,
                    'last_name' => fake()->lastName($gender), // для русской локали
                    'gender' => $gender,
                    'hire_date' => $hire_day,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];
        }
        //dd($employees);
        //> Опция для передачи огромных данных
        \DB::connection()->getPdo()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
        //<
        //dd($employees);
        \DB::table('employees')->insert($employees);
        //> Возвращаем значение опции обратно
        \DB::connection()->getPdo()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        //<
    }
}
