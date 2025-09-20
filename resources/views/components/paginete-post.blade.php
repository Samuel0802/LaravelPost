<nav aria-label="Page navigation example" class="mt-6">
    <ul class="flex items-center justify-center space-x-1">
        {{-- Botão Voltar --}}
        @if ($posts->onFirstPage())
            <li>
                <span class="px-3 py-2 rounded-md border border-gray-300 text-gray-400 cursor-not-allowed">
                    Voltar
                </span>
            </li>
        @else
            <li>
                <a href="{{ $posts->previousPageUrl() }}"
                   class="px-3 py-2 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
                    Voltar
                </a>
            </li>
        @endif

        {{-- Páginas --}}
        @for ($page = 1; $page <= $posts->lastPage(); $page++)
            @if ($posts->currentPage() == $page)
                <li>
                    <span class="px-3 py-2 rounded-md border border-blue-600 bg-blue-600 text-white font-semibold">
                        {{ $page }}
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $posts->url($page) }}"
                       class="px-3 py-2 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
                        {{ $page }}
                    </a>
                </li>
            @endif
        @endfor

        {{-- Botão Avançar --}}
        @if ($posts->hasMorePages())
            <li>
                <a href="{{ $posts->nextPageUrl() }}"
                   class="px-3 py-2 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
                    Avançar
                </a>
            </li>
        @else
            <li>
                <span class="px-3 py-2 rounded-md border border-gray-300 text-gray-400 cursor-not-allowed">
                    Avançar
                </span>
            </li>
        @endif
    </ul>
</nav>
