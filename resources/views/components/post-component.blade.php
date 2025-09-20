  <div class="mt-3">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="{{ Auth::id() === $post->user_id ? 'bg-blue-100' : 'bg-white' }} dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">

                            <div class="flex justify-between">
                                <div>
                                    <span class="text-gray-500 me-3">Autor:</span>
                                    <span class="text-blue-600">{{ $post->user->name }}</span>
                                </div>

                                   <div>
                                     <span class="text-gray-500 me-3">Post criado:</span>
                                    <span class="text-blue-600">{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y H:i:s') }}</span>
                                   </div>
                            </div>

                            <div class="mt-3 ps-5">
                               <h1 class="text-xl font-bold">{{ $post->titulo }}</h1>
                               <p class="mt-3">{{ $post->conteudo }}</p>
                            </div>

                            <div class="mt-3 ps-5 text-end">
                                 {{-- POST DELETE DO GATE --}}
                                 @can('post.delete', $post)
                                     <a href="{{ route('post.delete', ['id' => $post->id]) }}" class="bg-red-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">Excluir</a>
                                 @endcan
                            </div>



                        </div>
                    </div>
                </div>
            </div>
