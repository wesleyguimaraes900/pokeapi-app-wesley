<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@pokemon.com',
            'perfil' => 'admin',
            'password' => 'rootA123456'
        ]);

        User::create([
            'name' => 'Viewer',
            'email' => 'viewer@pokemon.com',
            'perfil' => 'viewer',
            'password' => 'rootV123456'
        ]);

        User::create([
            'name' => 'Editor',
            'email' => 'editor@pokemon.com',
            'perfil' => 'editor',
            'password' => 'rootE123456'
        ]);

    }

}
