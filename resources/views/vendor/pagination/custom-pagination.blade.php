@if($paginator->hasPages())
<ul class="pagination pagination-sm m-0 float-right">
    @if(!$paginator->onFirstPage())
    <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">«</a></li>
    @endif
    @for($i=0; $i < $paginator->lastPage();$i++)
        @if($paginator->currentPage() === $i+1)
        <li class="page-item active"><a class="page-link">{{$i+1}}</a></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->url($i+1)}}">{{$i+1}}</a></li>
        @endif
    @endfor

        @if($paginator->currentPage() !== $paginator->lastPage())
            <li class="page-item"><a class="page-link" href="{{$paginator->nextPageUrl()}}">»</a></li>
        @endif
</ul>
@endif

