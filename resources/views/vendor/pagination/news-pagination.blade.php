@if($paginator->hasPages())
    <ul>
        @if(!$paginator->onFirstPage())
            <li><a href="{{ $paginator->previousPageUrl() }}">«</a></li>
        @endif
        @for($i=0; $i < $paginator->lastPage();$i++)
            @if($paginator->currentPage() === $i+1)
                <li><a class="active" href="#">{{$i+1}}</a></li>
            @else
                <li><a href="{{ $paginator->url($i+1)}}">{{$i+1}}</a></li>
            @endif
        @endfor

        @if($paginator->currentPage() !== $paginator->lastPage())
            <li><a href="{{$paginator->nextPageUrl()}}">»</a></li>
        @endif
    </ul>
@endif
