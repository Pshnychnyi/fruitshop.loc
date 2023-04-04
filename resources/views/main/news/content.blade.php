<!-- latest news -->

<div class="latest-news mt-150 mb-150">
    <div class="container">
        @if($news && $news->isNotEmpty())
        <div class="row">
            @foreach($news as $item)
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-news">
                    <a href="{{route('main.news.show', ['news' => $item->id])}}">
                        <div class="latest-news-bg news-bg-1"><img height="200" width="350" src="{{asset('storage/' . $item->preview_image)}}" alt=""></div>
                    </a>
                    <div class="news-text-box">
                        <h3><a href="{{route('main.news.show', ['news' => $item->id])}}">{{$item->title}}</a></h3>
                        <p class="blog-meta">
                            <span class="author"><i class="fas fa-user"></i> {{$item->user->roles->first()->name}}</span>
                            <span class="date"><i class="fas fa-calendar"></i> {{$item->created_at->format('d F, Y')}}</span>
                        </p>
                        <p class="excerpt">{!!Str::limit($item->preview_text, 150)!!}</p>
                        <a href="{{route('main.news.show', ['news' => $item->id])}}" class="read-more-btn">Подобнее <i
                                class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="pagination-wrap">
                            {{ $news->links('vendor/pagination/news-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="text-center">Новостей пока нет!!!</div>
        @endif
    </div>
</div>
<!-- end latest news -->
