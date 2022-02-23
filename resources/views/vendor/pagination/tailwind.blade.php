@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="t-flex t-items-center t-justify-between">
        <div class="t-flex t-justify-between t-flex-1 sm:t-hidden">
            @if ($paginator->onFirstPage())
                <span class="t-relative t-inline-flex t-items-center t-px-4 t-py-2 t-text-sm t-font-medium t-text-gray-300 t-bg-white t-border t-border-gray-300 t-cursor-default t-leading-5 t-rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="t-relative t-inline-flex t-items-center t-px-4 t-py-2 t-text-sm t-font-medium t-text-gray-700 t-bg-white t-border t-border-gray-300 t-leading-5 t-rounded-md hover:t-text-gray-300 focus:t-outline-none focus:t-ring t-ring-gray-300 focus:t-border-blue-300 active:t-bg-gray-100 active:t-text-gray-700 t-transition t-ease-in-out t-duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="t-relative t-inline-flex t-items-center t-px-4 t-py-2 t-ml-3 t-text-sm t-font-medium t-text-gray-700 t-bg-white t-border t-border-gray-300 t-leading-5 t-rounded-md hover:t-text-gray-300 focus:t-outline-none focus:t-ring t-ring-gray-300 focus:t-border-blue-300 active:t-bg-gray-100 active:t-text-gray-700 t-transition t-ease-in-out t-duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="t-relative t-inline-flex t-items-center t-px-4 t-py-2 t-ml-3 t-text-sm t-font-medium t-text-gray-300 t-bg-white t-border t-border-gray-300 t-cursor-default t-leading-5 t-rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="t-hidden sm:t-flex-1 sm:t-flex sm:t-items-center sm:t-justify-between">
            <div>
                <p class="t-text-sm t-text-gray-700 t-leading-5">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="t-font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="t-font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="t-font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="t-relative t-z-0 t-inline-flex t-shadow-sm t-rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="t-relative t-inline-flex t-items-center t-px-2 t-py-2 t-text-sm t-font-medium t-text-gray-300 t-bg-white t-border t-border-gray-300 t-cursor-default t-rounded-l-md t-leading-5" aria-hidden="true">
                                <svg class="t-w-5 t-h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="t-relative t-inline-flex t-items-center t-px-2 t-py-2 t-text-sm t-font-medium t-text-gray-300 t-bg-white t-border t-border-gray-300 t-rounded-l-md t-leading-5 hover:t-text-gray-400 focus:t-z-10 focus:t-outline-none focus:t-ring t-ring-gray-300 focus:t-border-blue-300 active:t-bg-gray-100 active:t-text-gray-300 t-transition t-ease-in-out t-duration-150" aria-label="{{ __('pagination.previous') }}">
                            <svg class="t-w-5 t-h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="t-relative t-inline-flex t-items-center t-px-4 t-py-2 t--ml-px t-text-sm t-font-medium t-text-gray-700 t-bg-white t-border t-border-gray-300 t-cursor-default t-leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="t-relative t-inline-flex t-items-center t-px-4 t-py-2 t--ml-px t-text-sm t-font-medium t-text-gray-300 t-bg-white t-border t-border-gray-300 t-cursor-default t-leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="t-relative t-inline-flex t-items-center t-px-4 t-py-2 t--ml-px t-text-sm t-font-medium t-text-gray-700 t-bg-white t-border t-border-gray-300 t-leading-5 hover:t-text-gray-300 focus:t-z-10 focus:t-outline-none focus:t-ring t-ring-gray-300 focus:t-border-blue-300 active:t-bg-gray-100 active:t-text-gray-700 t-transition t-ease-in-out t-duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="t-relative t-inline-flex t-items-center t-px-2 t-py-2 t--ml-px t-text-sm t-font-medium t-text-gray-300 t-bg-white t-border t-border-gray-300 t-rounded-r-md t-leading-5 hover:t-text-gray-400 focus:t-z-10 focus:t-outline-none focus:t-ring t-ring-gray-300 focus:t-border-blue-300 active:t-bg-gray-100 active:t-text-gray-300 t-transition t-ease-in-out t-duration-150" aria-label="{{ __('pagination.next') }}">
                            <svg class="t-w-5 t-h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="t-relative t-inline-flex t-items-center t-px-2 t-py-2 t--ml-px t-text-sm t-font-medium t-text-gray-300 t-bg-white t-border t-border-gray-300 t-cursor-default t-rounded-r-md t-leading-5" aria-hidden="true">
                                <svg class="t-w-5 t-h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
