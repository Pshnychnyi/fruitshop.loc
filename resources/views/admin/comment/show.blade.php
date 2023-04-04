<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if($comment)
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <td>{{$comment->id}}</td>
                        </tr>
                        <tr>
                            <th>Имя</th>
                            <td>{{$comment->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$comment->email}}</td>
                        </tr>
                        <tr>
                            <th>Контент</th>
                            <td>{{$comment->content}}</td>
                        </tr>
                        <tr>
                            <th>Родительский комментарий</th>
                            @if($comment->parent_id)
                                <td><a href="{{ route('comment.show', ['comment' => $comment->parent_id]) }}">{{$comment->parent_id}}</a></td>
                            @else
                                <td><span>Отсутствует</span></td>
                            @endif
                        </tr>
                        <tr>
                            <th>Дата создания</th>
                            <td>{{$comment->created_at->format('d.M.Y')}}</td>
                        </tr>
                        </tbody>
                    </table>
                @else
                    <p>Коментария с таким id не существует</p>
                @endif
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
