<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if(isset($users) && $users->isNotEmpty())
                <div class="mb-2">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Новая запись</a>
                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th style="width: 130px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td class=text-center>
                                <a href="{{route('user.edit', ['user' => $user->id])}}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                <form class="d-inline" method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
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
                    <p>Пользовтелей пока нет! <a href="{{route('user.create')}}">Создать новую запись</a></p>
                @endif
            </div>

            <div class="card-footer clearfix">
                {{ $users->links()  }}
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
