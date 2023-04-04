<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if($comments && $comments->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Имя</th>
                        <th>Контент</th>
                        <th>Родительский комментарий</th>
                        <th style="width: 130px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td><a href="{{ route('comment.show', ['comment' => $comment->id]) }}">{{$comment->name}}</a></td>
                            <td>{{Str::limit($comment->content, 50)}}</td>
                            @if($comment->parent_id)
                                <td><a href="{{ route('comment.show', ['comment' => $comment->parent_id]) }}">{{$comment->parent_id}}</a></td>
                            @else
                                <td><span>Отсутствует</span></td>
                            @endif
                            <td class=text-center>
                                <form class="d-inline" method="POST" action="{{ route('comment.destroy', ['comment' => $comment->id]) }}">
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
                    <p>Коментариев пока нет!</p>
                @endif
            </div>

            <div class="card-footer clearfix">
                {{ $comments->links()  }}
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
