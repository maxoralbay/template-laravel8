@if ($paginator->hasPages())
    <div class="datatable-pager datatable-paging-loaded">
        <ul class="datatable-pager-nav my-2 mb-sm-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <a class="datatable-pager-link datatable-pager-link-prev datatable-pager-link-disabled" disabled="disabled">
                        <i class="flaticon2-back"></i>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="datatable-pager-link datatable-pager-link-prev">
                        <i class="flaticon2-back"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <a class="datatable-pager-link datatable-pager-link-prev datatable-pager-link-disabled" disabled="disabled">
                            {{ $element }}
                        </a>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <a href="{{ $url }}" class="datatable-pager-link datatable-pager-link-number datatable-pager-link-active">
                                    {{ $page }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="datatable-pager-link datatable-pager-link-prev">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif


                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" class="datatable-pager-link datatable-pager-link-prev">
                            &rsaquo;
                        </a>
                    </li>
                @else
                    <li>
                        <a class="datatable-pager-link datatable-pager-link-next datatable-pager-link-disabled" disabled="disabled">
                            <i class="flaticon2-next"></i>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
