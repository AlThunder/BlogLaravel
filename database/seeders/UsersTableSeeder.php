<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Автор неизвестен',
                'email' => 'author_unknon@g.g',
                'password' => bcrypt(\Str::random()),
            ],
            [
                'name' => 'Автор',
                'email' => 'author1@g.g',
                'password' => bcrypt('123123'),
            ]
        ];

        \DB::table('users')->insert($data);
    }
}
