<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if(isset($reviews) && $reviews->isNotEmpty())
                <div class="mb-2">
                    <a href="{{ route('review.create') }}" class="btn btn-primary">Новая запись</a>
                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Имя</th>
                        <th>Профессия</th>
                        <th>Описание</th>
                        <th style="width: 130px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{$review->id}}</td>
                            <td>{{$review->title}}</td>
                            <td>{{$review->profession}}</td>
                            <td>{{Str::limit($review->profession, 20)}}</td>
                            <td class=text-center>
                                <a href="{{route('review.edit', ['review' => $review->id])}}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                <form class="d-inline" method="POST" action="{{ route('review.destroy', ['review' => $review->id]) }}">
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
                    <p>Отзывов пока нет! <a href="{{route('review.create')}}">Создать новую запись</a></p>
                @endif
            </div>

            <div class="card-footer clearfix">
                {{ $reviews->links()  }}
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
