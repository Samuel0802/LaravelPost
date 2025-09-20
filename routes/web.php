<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    //Verificar se user esta autenticado
    if(auth()->check()){
        //se for true redireciona para dashboard
        return redirect()->route('dashboard');
    }else
     {
        return redirect()->route('login');
     }
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //PAGINA DE CRIAR POSTS
    Route::get('/posts/create', [MainController::class, 'createPost'])->name('post.create');
    Route::post('/posts/create', [MainController::class, 'postStore'])->name('post.store');
    //FUNÇÃO DE EXCLUIR POSTS
    Route::get('/posts/delete/{id}', [MainController::class, 'deletePost'])->name('post.delete');
});

require __DIR__.'/auth.php';
