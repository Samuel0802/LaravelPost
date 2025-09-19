<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //GATE PARA POSTS CREATE
        Gate::define('post.create', function(User $user){
            //usuario que esta autenticado e sua permissão é igual a admin ou usuario retorna true
            return ($user->role === 'admin' || $user->role === 'usuario');
        });

        //GATE PARA POSTS DELETE
          Gate::define('post.delete', function(User $user, $post){
            //Caso usuario for admin pode deletar todos os Post
            //usuario com permissao de user pode deletar seu proprio post
            return ($user->role === 'admin' || $user->id === $post->user_id);
        });
    }
}
