<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
        //$this->call(EmployeesTableSeeder::class);
        //\App\Models\Employees::factory(300000)->create();
        \App\Models\User::factory(8)->create();
        \App\Models\BlogPost::factory(100)->create();

    }
}
