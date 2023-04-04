<!-- single article section -->
<div class="mt-150 mb-150">
    <div class="container">
        @if($oneNews)
        <div class="row">
            <div class="col-lg-8">
                <div class="single-article-section">
                    <div class="single-article-text">
                        <div class="single-artcile-bg"><img src="{{asset('storage/' . $oneNews->img)}}" alt=""></div>
                        <p class="blog-meta">
                            <span class="author"><i class="fas fa-user"></i> {{$oneNews->user->roles->first()->name}}</span>
                            <span class="date"><i class="fas fa-calendar"></i> {{$oneNews->created_at->format('d F, Y')}}</span>
                        </p>
                        <h2>{{$oneNews->title}}</h2>
                        {!! $oneNews->content !!}
                    </div>

                    <div class="comments-list-wrap">
                        @if($comments->isNotEmpty())
                        <h3 class="comment-count-title">{{ $oneNews->comments->count() }} Comments</h3>
                        <div class="comment-list">

                        @foreach($comments as $key => $comment)
                                @if($key !== 0)
                                    @break
                                @endif
                                @include('main.news.comment', ['items' => $comment])
                            @endforeach
                        </div>
                        @endif
                    </div>
<!--                    <div id="respond">
                        <h3 id="reply-title">Leave a <span>Reply</span> <small><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">Cancel reply</a></small></h3>-->
                    <div class="comment-template" id="respond">
                        <h4 id="reply-title">Оставить комментарий</h4>
                        <span class="cancel-reply-link"><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">Отменить</a></span>
                        <p>Если у вас есть комментарий, не стесняйтесь присылать нам свое мнение.</p>

                        <form method="POST" action="{{route('main.comment')}}" id="commentForm">
                            @csrf
                            @if(!Auth::check())
                            <p>
                                <input type="text" name="name" placeholder="Имя">
                                <input type="email" name="email" placeholder="Email">
                            </p>
                            @endif
                            <p><textarea name="content" id="content" cols="30" rows="10" width="100%" placeholder="Введите сообщение"></textarea></p>

                            <input id="comment_post_ID" type="hidden" name="comment_post_ID" value="{{ $oneNews->id }}" />
                            <input id="comment_parent" type="hidden" name="comment_parent" value="0" />
                            <p><input name="submit" type="submit" id="submit" value="Отправить" /></p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-section">
                    @if($recentPosts->isNotEmpty())
                    <div class="recent-posts">
                        <h4>Последные статьи</h4>
                        <ul>
                            @foreach($recentPosts as $post)
                            <li><a href="{{route('main.news.show', ['news' => $post->id])}}">{{$post->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if($archives->isNotEmpty())
                    <div class="archive-posts">
                        <h4>Архив новостей</h4>
                        <ul>
                            @foreach($archives as $date => $archive)
                            <li><a href="single-news.html">{{Str::upper($date)}} ({{$archive->count()}})</a></li>
                            @endforeach

                        </ul>
                    </div>
                    @endif
                    @if($oneNews->tags->isNotEmpty())
                    <div class="tag-section">
                        <h4>Теги</h4>
                        <ul>
                            @foreach($oneNews->tags as $tag)
                            <li><a href="single-news.html">{{$tag->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- end single article section -->
