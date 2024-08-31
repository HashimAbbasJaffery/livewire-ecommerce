


@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">

            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                    </a>
                </li>
            @else
                <li class="page-item disabled" wire:click="previousPage">
                    <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                    </a>
                </li>
            @endif


             @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true">
                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">{{ $element }}</span>
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li wire:click="setPage('{{ $page }}')" class="page-item" aria-current="page"><a class="page-link" href="#">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->onLastPage())
                <li class="page-item">
                    <a class="page-link page-link-next" style="opacity: 0.5; cursor: not-allowed;" href="#" aria-label="Next">
                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                    </a>
                </li>
            @else
                <li class="page-item" wire:click="nextPage">
                    <a class="page-link page-link-next" href="#" aria-label="Next">
                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                    </a>
                </li>
            @endif

        </ul>
    </nav>
@endif

