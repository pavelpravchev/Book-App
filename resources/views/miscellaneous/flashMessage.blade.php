@php
    $flashMessage = session()->get('flash');
@endphp
@if(!is_null($flashMessage))
    <div class="alert alert-{{ $flashMessage['type'] }}">
        {{ $flashMessage['message'] }}
    </div>
@endif
