<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];

        foreach (range(1, 3) as $i) {
            $users[] = [
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => "123123"
            ];
        }

        DB::table('users')->insert($users);
    }
}