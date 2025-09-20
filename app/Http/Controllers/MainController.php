<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MainController extends Controller
{
    public function index()
    {

        //obter todas as postagens e os dados do usuário que criou a postagem
        $posts = Post::with('user')->get();

        return view('dashboard', ['posts' => $posts]);
    }

    //PAGINA DE CRIAR POSTS
    public function createPost(Request $request)
    {

        //Se Gate não for permitido
        if (Gate::denies('post.create')) {
            abort(403, 'Você não tem permissão para acessar essa página');
        }

        return view('create-post');
    }

    //SALVAR OS POSTS
    public function postStore(Request $request)
    {

        //Se Gate não for permitido
        if (Gate::denies('post.create')) {
            abort(403, 'Você não tem permissão para acessar essa página');
        }

        $regra = [
            'titulo' => 'required|min:3|max:100',
            'conteudo' => 'required|min:3|max:1000'
        ];

        $feedback = [
            'titulo' => 'Título é obrigatório',
            'titulo.min' => 'Título deve ter no mínimo :min caracteres',
            'titulo.max' => 'Título deve ter no máximo :max caracteres',
            'conteudo' => 'Conteúdo é obrigatório',
            'conteudo.min' => 'Conteúdo deve ter no mínimo :min caracteres',
            'conteudo.max' => 'Conteúdo deve ter no máximo :max caracteres'

        ];

        $request->validate($regra, $feedback);

        //Caso tudo for true -> cria o post
        try {

          Post::create([
            'titulo' => $request->input('titulo'),
            'conteudo' => $request->input('conteudo'),
            'user_id' => Auth::user()->id,

          ]);

          return redirect()->route('dashboard')->with('success', 'Post criado com sucesso!');

        } catch (\Exception $e) {

         return back()->withInput()->with('error', 'Erro ao criar post');
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

        // soft delete
        // $post->delete();

        //Hard Delete
        $post->ForceDelete();


        return redirect()->route('dashboard');
    }
}
