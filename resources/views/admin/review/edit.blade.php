<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if($review)
        <div class="card card-primary">
            <form method="POST" action="{{route('review.update', ['review' => $review->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Имя</label>
                        <input type="text" name="title" value="{{$review->title}}" class="form-control" id="title" placeholder="Введите имя">
                    </div>
                    <div class="form-group">
                        <label for="profession">Профессия</label>
                        <input type="text" name="profession" value="{{$review->profession}}" class="form-control" id="profession" placeholder="Введите наименование">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" class="form-control" id="review_desc" placeholder="Введите описание">{{$review->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <img class="img-thumbnail" width="200px" src="{{ asset('storage/' . $review->img) }}" alt="">
                    </div>
                    <div class="form-group">
                        <label for="img">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="img" class="custom-file-input" id="img">
                                <label class="custom-file-label" for="img">Выбрать файл</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>

        </div>
        @else
            <div>
                <p>Записи с таким id не существует</p>
            </div>

        @endif
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
