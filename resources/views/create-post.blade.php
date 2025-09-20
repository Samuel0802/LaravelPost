<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            NOVO POST
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mb-6 mt-5 bg-white dark:bg-gray-800 rounded-md shadow-md p-10">

        <form action="{{ route('post.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Primeiro campo Título -->
            <div class="flex flex-col gap-2 px-2 py-2">
                <label for="titulo" class="text-sm font-medium text-gray-700 dark:text-gray-200">
                    Titulo
                </label>
                <input
                    type="text"
                    name="titulo"
                    id="titulo"
                    class="block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-3 py-2"
                    placeholder="Digite o título do post"
                />
                @error('titulo')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            <!-- Segundo campo conteudo -->
            <div class="flex flex-col gap-2 px-2">
                <label for="conteudo" class="text-sm font-medium text-gray-700 dark:text-gray-200">
                    Conteúdo
                </label>
                <textarea
                    name="conteudo"
                    id="conteudo"
                    rows="4"
                    class="block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-3 py-2"
                    placeholder="Digite o conteúdo do post"
                ></textarea>
                @error('conteudo')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 flex justify-between px-2 py-2">
                 <a href="{{  route('dashboard') }}" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-6 rounded">Voltar</a>
                 <button type="submit" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-6 rounded" >Criar Post</button>
            </div>

        </form>
    </div>
</x-app-layout>
