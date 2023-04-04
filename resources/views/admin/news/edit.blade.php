<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            @if($news)
            <form method="POST" action="{{route('news.update', ['news' => $news->id])}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" name="title" value="{{$news->title}}" class="form-control" id="title" placeholder="Введите заголовок">
                    </div>
                    <div class="form-group">
                        <label for="preview_text">Превью контент</label>
                        <textarea class="form-control" name="preview_text" id="preview_text">{{$news->preview_text}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Контент</label>
                        <textarea name="content" id="content">{{$news->content}}</textarea>
                    </div>
                    @if($tags->isNotEmpty())
                        <div class="form-group">
                            <label>Теги</label>
                            <select class="form-control" name="tags[]" multiple="" id="tag" data-placeholder="Выберите теги">
                                @foreach($tags as $tag)
                                    <option {{$news->tags->pluck('id')->contains($tag->id) ? 'selected' : ''}} value="{{$tag->id}}">{{$tag->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if($news->preview_image)
                    <div class="form-group">
                        <img class="img-thumbnail" width="200px" src="{{ asset('storage/' . $news->preview_image) }}" alt="">
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="img">Превью</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="preview_image"  class="custom-file-input" id="preview_image">
                                <label class="custom-file-label" for="preview_image">Выбрать файл</label>
                            </div>
                        </div>
                    </div>
                    @if($news->img)
                    <div class="form-group">
                        <img class="img-thumbnail" width="200px" src="{{ asset('storage/' . $news->img) }}" alt="">
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="img">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="img"  class="custom-file-input" id="img">
                                <label class="custom-file-label" for="img">Выбрать файл</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
            @else
                <p>Категория не найдена</p>
            @endif
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
