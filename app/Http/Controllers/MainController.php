<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){

        //obter todas as postagens e os dados do usuário que criou a postagem
        $posts = Post::with('user')->get();

         return view('dashboard', ['posts' => $posts]);
    }
}
