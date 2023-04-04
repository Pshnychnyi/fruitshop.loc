<div style="background: #e0e0e0; border-radius: 30px 30px" class="single-comment-body {{$item['parent_id'] ? 'child' : ''}}">
    <div class="comment-user-avater">
        <img src="{{asset('storage/img/noavatar.webp')}}" alt="">
    </div>
    <div class="comment-text-body">
        <h4>{{isset($item['name']) ? $item['name'] : ''}}<span class="comment-date">Только что</span></h4>
        <p>{!! $item['content'] !!}</p>
    </div>
</div>
