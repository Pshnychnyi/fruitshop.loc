<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <form method="POST" action="{{route('news.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" placeholder="Введите заголовок">
                    </div>
                    <div class="form-group">
                        <label for="preview_text">Превью контент</label>
                        <textarea name="preview_text" id="preview_text">{{old('preview_text')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Контент</label>
                        <textarea name="content" id="content">{{old('content')}}</textarea>
                    </div>
                    @if($tags->isNotEmpty())
                        <div class="form-group">
                            <label>Теги</label>
                            <select class="form-control" name="tags[]" multiple="" id="tag" data-placeholder="Выберите теги">
                                @foreach($tags as $tag)
                                    <option {{is_array(old('tags')) && in_array($tag->title, old('tags')) ? 'selected' : ''}} value="{{$tag->id}}">{{$tag->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="img">Превью</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="preview_image" value="{{old('preview_image')}}" class="custom-file-input" id="preview_image">
                                <label class="custom-file-label" for="preview_image">Выбрать файл</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="img" value="{{old('img')}}" class="custom-file-input" id="img">
                                <label class="custom-file-label" for="img">Выбрать файл</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
