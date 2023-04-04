<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if($team)
        <div class="card card-primary">
            <form method="POST" action="{{route('team.update', ['team' => $team->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" name="name" value="{{$team->name}}" class="form-control" id="name" placeholder="Введите имя">
                    </div>
                    <div class="form-group">
                        <label for="profession">Профессия</label>
                        <input type="text" name="profession" value="{{$team->profession}}" class="form-control" id="profession" placeholder="Введите наименование">
                    </div>
                    <div class="form-group">
                        <img class="img-thumbnail" width="200px" src="{{ asset('storage/' . $team->img) }}" alt="">
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
