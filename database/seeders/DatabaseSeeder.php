<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
       if(!App::environment('production')){
          $this->call([
            UsersSeeder::class,
            PostSeeder::class,
          ]);
       }
    }
}
