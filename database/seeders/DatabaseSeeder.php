<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Question;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Question::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Mohamed',
        //     'email' => 'med@gmail.com',
        //     'password' => '1234',
        //     'role_id' => 2
        // ]);
        
        // Role::factory()->create([
        //     'name' => 'student',
        // ]);
    }
}
