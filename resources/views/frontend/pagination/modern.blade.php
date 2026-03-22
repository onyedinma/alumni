@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="premium-pagination flex items-center justify-center py-4">
        <div class="flex flex-wrap items-center justify-center gap-1 md:gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center justify-center w-8 h-8 md:w-10 md:h-10 px-2 py-2 text-xs md:text-sm font-medium text-gray-500 bg-gray-800/50 border border-gray-700/50 cursor-not-allowed rounded-lg opacity-50 backdrop-blur-sm">
                    <i class="fa-solid fa-angles-left text-xs"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="relative inline-flex items-center justify-center w-8 h-8 md:w-10 md:h-10 px-2 py-2 text-xs md:text-sm font-medium text-gray-300 bg-gray-900/80 border border-gray-700/80 rounded-lg hover:bg-maroon hover:border-maroon hover:text-white transition-all duration-300 ease-in-out backdrop-blur-sm shadow-lg hover:shadow-maroon/20 hover:-translate-y-0.5"
                    aria-label="{{ __('pagination.previous') }}">
                    <i class="fa-solid fa-angles-left text-xs"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span
                        class="relative inline-flex items-center justify-center w-8 h-8 md:w-10 md:h-10 px-2 py-2 text-xs md:text-sm font-medium text-gray-500 cursor-default">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page">
                                <span
                                    class="relative inline-flex items-center justify-center w-8 h-8 md:w-10 md:h-10 px-2 md:px-4 py-2 text-xs md:text-sm font-bold text-white bg-gradient-to-br from-maroon to-maroon-dark border border-maroon rounded-lg shadow-lg shadow-maroon/30 transform scale-105 pointer-events-none">{{ $page }}</span>
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="relative inline-flex items-center justify-center w-8 h-8 md:w-10 md:h-10 px-2 md:px-4 py-2 text-xs md:text-sm font-medium text-gray-300 bg-gray-900/80 border border-gray-700/80 rounded-lg hover:bg-maroon hover:border-maroon hover:text-white transition-all duration-300 ease-in-out backdrop-blur-sm shadow-lg hover:shadow-maroon/20 hover:-translate-y-0.5"
                                aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="relative inline-flex items-center justify-center w-8 h-8 md:w-10 md:h-10 px-2 py-2 text-xs md:text-sm font-medium text-gray-300 bg-gray-900/80 border border-gray-700/80 rounded-lg hover:bg-maroon hover:border-maroon hover:text-white transition-all duration-300 ease-in-out backdrop-blur-sm shadow-lg hover:shadow-maroon/20 hover:-translate-y-0.5"
                    aria-label="{{ __('pagination.next') }}">
                    <i class="fa-solid fa-angles-right text-xs"></i>
                </a>
            @else
                <span
                    class="relative inline-flex items-center justify-center w-8 h-8 md:w-10 md:h-10 px-2 py-2 text-xs md:text-sm font-medium text-gray-500 bg-gray-800/50 border border-gray-700/50 cursor-not-allowed rounded-lg opacity-50 backdrop-blur-sm">
                    <i class="fa-solid fa-angles-right text-xs"></i>
                </span>
            @endif
        </div>
    </nav>
@endif