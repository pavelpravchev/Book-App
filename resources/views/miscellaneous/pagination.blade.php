@if ($pagination['allResultsCount'] > $pagination['limit'])

    <nav aria-label="Page navigation example">
      <ul class="pagination">
          <li class="page-item">
              <a
                  class="page-link"
                  href="{{ route('home', ['page' => $pagination['min']]) }}"
              >First</a>
          </li>
@for(
    $i = ($pagination['currentPage'] -2);
    $i < $pagination['currentPage'];
    $i++
)
    @if ($i >= $pagination['min'])
        <li class="page-item">
            <a class="page-link"
               href="{{ route('home', ['page' => $i]) }}">{{ $i }}</a>
        </li>
    @endif
@endfor
    @for($i = $pagination['currentPage']; $i < $pagination['currentPage'] + 2; $i++)
        @if ($i < $pagination['currentPage'] + 2)
            <li class="page-item">
                <a class="page-link"
                   href="{{ route('home', ['page' => $i]) }}">{{ $i }}</a>
            </li>
        @endif
    @endfor
          <li class="page-item"><a class="page-link" href="{{ route('home', ['page' => $pagination['max']]) }}">Last</a></li>
      </ul>
    </nav>
@endif
