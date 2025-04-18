<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegurarse de que el rol 'admin' existe
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Crear usuario administrador
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Clave única para evitar duplicados
            [
                'name' => 'admin',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now(),
            ]
        );

        // Asignar rol si aún no lo tiene
        if (!$user->hasRole('admin')) {
            $user->assignRole($adminRole);
        }

    }
}
