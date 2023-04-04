<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <form method="POST" action="{{route('category.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Категория</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" placeholder="Введите наименование">
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
