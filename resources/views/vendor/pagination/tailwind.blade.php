@if ($paginator->hasPages())
<div class="d-flex justify-content-between align-items-center">
    {{-- Left side: Pagination info --}}
    <div class="pagination-info">
        Showing <strong>{{ $paginator->firstItem() }}</strong> to
        <strong>{{ $paginator->lastItem() }}</strong> of
        <strong>{{ $paginator->total() }}</strong> results
    </div>

    {{-- Right side: Pagination controls --}}
    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">
            {{-- Previous button --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
                </li>
            @endif

            {{-- Page links --}}
            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();
                $window = 2; // Number of pages to show around current page

                $pages = [];

                // Always show first page
                $pages[] = 1;

                // Show pages around current page
                $start = max(2, $current - $window);
                $end = min($last - 1, $current + $window);

                if ($start > 2) {
                    $pages[] = '...';
                }

                for ($i = $start; $i <= $end; $i++) {
                    $pages[] = $i;
                }

                if ($end < $last - 1) {
                    $pages[] = '...';
                }

                // Always show last page
                if ($last > 1) {
                    $pages[] = $last;
                }
            @endphp

            @foreach ($pages as $page)
                @if ($page === '...')
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @elseif ($page == $current)
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- Next button --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
</div>
@endif

<style>
.pagination {
  display: flex;
  padding-left: 0;
  list-style: none;
  border-radius: 0.25rem;
  margin-bottom: 0;
}

.pagination-info {
  font-size: 0.9rem;
  color: #6c757d;
}

.page-item:first-child .page-link {
  margin-left: 0;
  border-top-left-radius: 0.25rem;
  border-bottom-left-radius: 0.25rem;
}

.page-item:last-child .page-link {
  border-top-right-radius: 0.25rem;
  border-bottom-right-radius: 0.25rem;
}

.page-item.active .page-link {
  z-index: 1;
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
}

.page-item.disabled .page-link {
  color: #6c757d;
  pointer-events: none;
  background-color: #fff;
  border-color: #dee2e6;
}

.page-link {
  position: relative;
  display: block;
  padding: 0.5rem 0.75rem;
  margin-left: -1px;
  line-height: 1.25;
  color: #007bff;
  background-color: #fff;
  border: 1px solid #dee2e6;
  text-decoration: none;
}

.page-link:hover {
  color: #0056b3;
  background-color: #e9ecef;
  border-color: #dee2e6;
}

.d-flex {
  display: flex;
}

.justify-content-between {
  justify-content: space-between;
}

.align-items-center {
  align-items: center;
}

.mb-0 {
  margin-bottom: 0;
}
</style>
