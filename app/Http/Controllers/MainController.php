<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index()
    {

        //obter todas as postagens e os dados do usuário que criou a postagem
        $posts = Post::with('user')->paginate(3);
        Log::info('Listando os Posts', ['user' =>  Auth::user()->id]);

        return view('dashboard', ['posts' => $posts]);
    }

    //PAGINA DE CRIAR POSTS
    public function createPost(Request $request)
    {

        //Se Gate não for permitido
        if (Gate::denies('post.create')) {
            Log::alert('Usuario tentou acessar criar posts', ['user' =>  Auth::user()->id]);
            abort(403, 'Você não tem permissão para acessar essa página');
        }

        Log::info('Usuario entrou na pagina criar Post', ['user' =>  Auth::user()->id]);

        return view('create-post');
    }

    //SALVAR OS POSTS
    public function postStore(Request $request)
    {

        //Se Gate não for permitido
        if (Gate::denies('post.create')) {
             Log::alert('Usuario tentou acessar criar posts', ['user' =>  Auth::user()->id]);
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
           Log::info('Usuario criou novo Post', ['user' =>  Auth::user()->id]);

          return redirect()->route('dashboard')->with('success', 'Post criado com sucesso!');

        } catch (\Exception $e) {

             Log::error('Erro ao criar post', ['user' =>  Auth::user()->id, 'error' => $e->getMessage()]);

         return back()->withInput()->with('error', 'Erro ao criar post');
        }
    }

    //EXCLUIR OS POSTS
    public function deletePost($id)
    {
       try {
        //Buscar post especifico pelo id
        $post = Post::findOrFail($id);

        //Se Gate não for permitido
        if (Gate::denies('post.delete', $post)) {
               Log::alert('Usuario tentou apagar posts', ['user' =>  Auth::user()->id]);
            abort(403, 'Você não tem permissão para acessar essa página');
        }

        // soft delete
        // $post->delete();

        //Hard Delete
        Log::info('Usuario apagou post', ['user' =>  Auth::user()->id]);
        $post->ForceDelete();


        return redirect()->route('dashboard');

       } catch (\Exception $e) {

         Log::info('Error ao apagar post', ['user' =>  Auth::user()->id, 'error' => $e->getMessage()]);
         return back()->withInput()->with('error', 'Erro ao apagar post');
       }
    }
}
