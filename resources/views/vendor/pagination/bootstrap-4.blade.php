@if($paginator->hasPages())
    @php
        $get_params = "&";
        foreach($filterModel as $param => $value){
            if($value != null && $param != "page")
                $get_params .= "$param=$value&";
        }
    @endphp
    <nav class="main-pagination-wrapp d-flex justify-content-center" aria-label="page navigation">
        <ul class="pagination flex-wrap rounded-0">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="">
                    <a class="page-link text-tert-clr font-15 rounded-0">Previous</a>
                </li>
            @else
                <li class="page-item" aria-disabled="true" aria-label="">
                    <a class="page-link text-tert-clr font-15 rounded-0" href="{{ $paginator->previousPageUrl() }}{{$get_params}}" rel="prev" aria-label="">Previous</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link text-gray-clr font-16">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link text-gray-clr font-16">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item"><a class="page-link text-gray-clr font-16" href="{{ $url }}{{$get_params}}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}{{$get_params}}" rel="next" aria-label="">Next</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="">
                    <span class="page-link text-tert-clr font-15 rounded-0" aria-hidden="true">Next</span>
                </li>
            @endif

        </ul>
    </nav>
@endif
