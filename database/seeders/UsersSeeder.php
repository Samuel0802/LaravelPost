<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class UsersSeeder extends Seeder
{

    public function run(): void
    {
        //Verificar se o usuário está cadastrado no banco de dados.
        //Recuperando apenas o primeiro registro
        if (!User::where('email', 'admin@gmail.com')->first()) {
            User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Admin123'),
                'role' => 'admin'
            ]);
        }

        //Se ambiente for diferente de produção, cadastrar no banco local
        if (App::environment() !== 'production') {

            User::firstOrCreate(
                //Verificar se o usuário está cadastrado no banco de dados.
                ['email' => 'user@gmail.com'],

                [
                    'name' => 'user',
                    'email' => 'user@gmail.com',
                    'password' => bcrypt('Admin123'),
                    'role' => 'usuario'
                ]
            );

            User::firstOrCreate(

                //Verificar se o usuario esta cadastrado no banco de dados.
                ['email' => 'visitante@gmail.com'],
                [
                    'name' => 'visitante',
                    'email' => 'visitante@gmail.com',
                    'password' => bcrypt('Admin123'),
                    'role' => 'visitante'
                ]
            );
        }
    }
}
