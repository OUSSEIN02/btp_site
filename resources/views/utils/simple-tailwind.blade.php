@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation"
     class="mt-12 w-full">

    <div class="flex flex-col items-center gap-6">

        {{-- ===== MOBILE VERSION ===== --}}
        <div class="flex items-center justify-between w-full md:hidden">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-full">
                    ←
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-4 py-2 text-sm bg-white rounded-full shadow hover:bg-brand hover:text-white transition ajax-pagination"
                   data-page="{{ $paginator->currentPage() - 1 }}">
                    ←
                </a>
            @endif

            {{-- Page indicator --}}
            <span class="text-sm text-gray-600 font-medium">
                Page {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-4 py-2 text-sm bg-white rounded-full shadow hover:bg-brand hover:text-white transition ajax-pagination"
                   data-page="{{ $paginator->currentPage() + 1 }}">
                    →
                </a>
            @else
                <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-full">
                    →
                </span>
            @endif
        </div>


        {{-- ===== DESKTOP VERSION ===== --}}
        <div class="hidden md:flex items-center gap-3">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-full">
                    ← Précédent
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-5 py-2 text-sm font-medium bg-white rounded-full shadow-sm hover:shadow-md hover:bg-brand hover:text-white transition ajax-pagination"
                   data-page="{{ $paginator->currentPage() - 1 }}">
                    ← Précédent
                </a>
            @endif


            {{-- Pages --}}
            @foreach ($elements as $element)

                @if (is_string($element))
                    <span class="px-3 text-gray-400">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 text-sm font-semibold text-white bg-brand rounded-full shadow-md scale-105">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="px-4 py-2 text-sm font-medium text-gray-600 bg-white rounded-full hover:bg-brand hover:text-white hover:shadow-md transition ajax-pagination"
                               data-page="{{ $page }}">
                                {{ $page }}
                            </a>
                        @endif

                    @endforeach
                @endif

            @endforeach


            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-5 py-2 text-sm font-medium bg-white rounded-full shadow-sm hover:shadow-md hover:bg-brand hover:text-white transition ajax-pagination"
                   data-page="{{ $paginator->currentPage() + 1 }}">
                    Suivant →
                </a>
            @else
                <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-full">
                    Suivant →
                </span>
            @endif

        </div>

    </div>
</nav>
@endif