<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\password;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::create(
            [
                "name" => "Admin",
                "email" => "a@a.com",
                "password" => bcrypt("12345678"),
                "specialization_id" => null,
            ]);
        $user->assignRole("Admin");
    }
}
