<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Berna',
            'email' => 'benano51@gmail.com',
            'password' => bcrypt('Ner52do10ca'),
            'foto' => 'images/fotos/Berna.jpg',
        ])->assignRole('Administrador');
        User::create([
            'name' => 'General',
            'email' => 'general@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Operador');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Administrador');
    }
}
