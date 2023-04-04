<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if(isset($categories) && $categories->isNotEmpty())
                <div class="mb-2">
                    <a href="{{ route('category.create') }}" class="btn btn-primary">Новая запись</a>
                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Наименование</th>
                        <th style="width: 130px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->title}}</td>
                            <td class=text-center>
                                <a href="{{route('category.edit', ['category' => $category->id])}}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                <form class="d-inline" method="POST" action="{{ route('category.destroy', ['category' => $category->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <p>Категорий пока нет! <a href="{{route('category.create')}}">Создать новую запись</a></p>
                @endif
            </div>

            <div class="card-footer clearfix">
                {{ $categories->links()  }}
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
