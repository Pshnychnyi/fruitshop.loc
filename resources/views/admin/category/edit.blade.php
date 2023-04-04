<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            @if($category)
            <form method="POST" action="{{route('category.update', ['category' => $category->id])}}">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Наименование</label>
                        <input type="text" name="title" value="{{$category->title}}" class="form-control" id="title" placeholder="Введите наименование">
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
