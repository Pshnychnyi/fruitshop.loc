@foreach($items as $item)

    <div id="comment-{{ $item->id }}" class="single-comment-body {{$item->parent_id ? 'child' : ''}}">
        <div class="comment-user-avater">
            <img src="{{asset('storage/img/noavatar.webp')}}" alt="">
        </div>
        <div class="comment-text-body">
            <h4>{{ isset($item->user->name) ? $item->user->name : $item->name}} <span class="comment-date">{{$item->dateAsCarbon->diffForHumans()}}</span> <a class="comment-reply-link" href="#respond" onclick="return addComment.moveForm(&quot;comment-{{$item->id}}&quot;, &quot;{{$item->id}}&quot;, &quot;respond&quot;, &quot;{{$item->news_id}}&quot;)">Ответить</a></h4>
            <p>{!! $item->content !!}</p>
        </div>

        @if(isset($comments[$item->id]))
            @include('main.news.comment', ['items' => $comments[$item->id]])
        @endif
    </div>
@endforeach
