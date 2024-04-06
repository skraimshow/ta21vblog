@if ($paginator->hasPages())
<div class="join grid grid-cols-2">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <button class="join-item btn btn-outline" disabled>@lang('pagination.previous')</button>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="join-item btn btn-outline">@lang('pagination.previous')</a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="join-item btn btn-outline">@lang('pagination.next')</a>
    @else
    <button class="join-item btn btn-outline" disabled>@lang('pagination.next')</button>
    @endif
</div>
@endif