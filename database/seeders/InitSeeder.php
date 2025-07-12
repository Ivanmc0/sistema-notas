<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles si no existen
        $roles = ['administrador', 'profesor', 'estudiante', 'padre'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Crear usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@colegio.test'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123'),
            ]
        );

        // Asignar rol
        if (!$admin->hasRole('administrador')) {
            $admin->assignRole('administrador');
        }
    }
}
