<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user=User::factory()->create([
            'name' => 'Manuel Romero',
            'email' => 'manuelromeromiguel@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('student');
        $user=User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole('admin');
        $user=User::factory()->create([
            'name' => 'Manuel Romero',
            'email' => 'manuel.romero@cpilosenlaces.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('teacher');

    }
}
