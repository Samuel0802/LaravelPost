<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MainController extends Controller
{
    public function index()
    {

        //obter todas as postagens e os dados do usuário que criou a postagem
        $posts = Post::with('user')->get();

        return view('dashboard', ['posts' => $posts]);
    }

    //CRIAR OS POSTS
    public function createPost(Request $request)
    {

        //Se Gate não for permitido
        if (Gate::denies('post.create')) {
            abort(403, 'Você não tem permissão para acessar essa página');
        }
    }

    //EXCLUIR OS POSTS
    public function deletePost($id)
    {
         //Buscar post especifico pelo id
         $post = Post::findOrFail($id);

        //Se Gate não for permitido
        if (Gate::denies('post.delete', $post)) {
            abort(403, 'Você não tem permissão para acessar essa página');
        }

        $post->delete(); // soft delete

        return redirect()->route('dashboard');


    }
}
