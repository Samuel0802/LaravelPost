<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class PostSeeder extends Seeder
{

    public function run(): void
    {
        if (!App::environment('production')) {

            Post::create([
                'user_id' => 1,
                'titulo' => 'Olá a Todos!',
                'conteudo' => 'Este é o primeiro conteúdo genérico de teste.',

            ]);

            Post::create([
                'user_id' => 1,
                'titulo' => 'Laravel é incrível',
                'conteudo' => 'Aprendendo como usar Eloquent, migrations e seeders.',

            ]);

            Post::create([
                'user_id' => 2,
                'titulo' => 'Bem-vindo ao sistema',
                'conteudo' => 'Este é o primeiro conteúdo genérico de teste.',

            ]);

            Post::create([
                'user_id' => 2,
                'titulo' => 'Notícia de exemplo',
                'conteudo' => 'Este é mais um exemplo de conteúdo fake para testes.',

            ]);

            Post::create([
                'user_id' => 1,
                'titulo' => 'Último conteúdo de teste',
                'conteudo' => 'Gerado automaticamente pelo seeder.',

            ]);
        }
    }
}
