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
        $admin = User::updateOrCreate(
            ['email' => 'admin@colegio.test'], // El campo para buscar
            [
                'name' => 'Administrador', // El campo para actualizar o crear
                'password' => Hash::make('password123'), // El campo para actualizar o crear
            ]
        );

        // Asignar rol
        if (!$admin->hasRole('administrador')) {
            $admin->assignRole('administrador');
        }
    }
}
