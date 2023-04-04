<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if(isset($allNews) && $allNews->isNotEmpty())
                <div class="mb-2">
                    <a href="{{ route('news.create') }}" class="btn btn-primary">Новая запись</a>
                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Заголовок</th>
                        <th>Контент</th>
                        <th>Автор</th>
                        <th style="width: 130px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allNews as $news)
                        <tr>
                            <td>{{$news->id}}</td>
                            <td>{{$news->title}}</td>
                            <td>{!! Str::limit($news->content, 50) !!}</td>
                            <td>{{$news->user->name}}</td>
                            <td class=text-center>
                                <a href="{{route('news.edit', ['news' => $news->id])}}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                <form class="d-inline" method="POST" action="{{ route('news.destroy', ['news' => $news->id]) }}">
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
                    <p>Новостей пока нет! <a href="{{route('news.create')}}">Создать новую запись</a></p>
                @endif
            </div>

            <div class="card-footer clearfix">
                {{ $allNews->links()  }}
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
