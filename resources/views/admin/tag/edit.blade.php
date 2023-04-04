<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            @if($tag)
            <form method="POST" action="{{route('tag.update', ['tag' => $tag->id])}}">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Категория</label>
                        <input type="text" name="title" value="{{$tag->title}}" class="form-control" id="title" placeholder="Введите наименование">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
            @else
                <div>
                    <p>Записи с таким id не существует</p>
                </div>
            @endif
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
