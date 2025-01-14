<style>
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 5px;
    }

    .pagination .page-item {
        margin: 0;
    }

    .pagination .page-link {
        text-decoration: none;
        padding: 6px 12px;
        color: white;
        background-color: #FF9800;
        border: 1px solid #FF9800;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .pagination .page-link:hover {
        background-color: #FF9800;
    }

    .pagination .page-item.disabled .page-link {
        background-color: #6c757d;
        border-color: #6c757d;
        pointer-events: none;
    }

    .pagination .page-item.active .page-link {
        background-color: #FF9800;
        border-color: #FF9800;
    }

    .results-info {
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start;
        }

        .results-info {
            margin-bottom: 10px;
        }

        .pagination .page-link {
            font-size: 12px !important;
            padding: 6px 10px !important;
        }
    }
</style>

@if ($paginator->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-2">
        <div class="results-info">
            Showing {{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }}
            to {{ min($paginator->currentPage() * $paginator->perPage(), $paginator->total()) }}
            of {{ $paginator->total() }} results
        </div>

        <ul class="pagination">
            {{-- Previous Button --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link text-white rounded-sm" href="{{ $paginator->previousPageUrl() }}"
                    rel="prev">&laquo;</a>
            </li>

            {{-- Page Numbers --}}
            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();
                $start = max(1, $currentPage - 2);
                $end = min($lastPage, $currentPage + 2);
            @endphp

            {{-- First Page and Ellipsis --}}
            @if ($start > 1)
                <li class="page-item">
                    <a class="page-link text-white rounded-sm" href="{{ $paginator->url(1) }}">1</a>
                </li>
                @if ($start > 2)
                    <li class="page-item disabled"><span class="page-link text-white rounded-sm">...</span></li>
                @endif
            @endif

            {{-- Visible Page Numbers --}}
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                    <a class="page-link text-white rounded-sm" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Last Page and Ellipsis --}}
            @if ($end < $lastPage)
                @if ($end < $lastPage - 1)
                    <li class="page-item disabled"><span class="page-link text-white rounded-sm">...</span></li>
                @endif
                <li class="page-item">
                    <a class="page-link text-white rounded-sm"
                        href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a>
                </li>
            @endif

            {{-- Next Button --}}
            <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link text-white rounded-sm" href="{{ $paginator->nextPageUrl() }}"
                    rel="next">&raquo;</a>
            </li>
        </ul>
    </div>
@endif
