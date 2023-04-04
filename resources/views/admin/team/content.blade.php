<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if(isset($teams) && $teams->isNotEmpty())
                <div class="mb-2">
                    <a href="{{ route('team.create') }}" class="btn btn-primary">Новая запись</a>
                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Имя</th>
                        <th>Профессия</th>
                        <th style="width: 130px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teams as $team)
                        <tr>
                            <td>{{$team->id}}</td>
                            <td>{{$team->name}}</td>
                            <td>{{$team->profession}}</td>
                            <td class=text-center>
                                <a href="{{route('team.edit', ['team' => $team->id])}}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                <form class="d-inline" method="POST" action="{{ route('team.destroy', ['team' => $team->id]) }}">
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
                    <p>Сотрудников пока нет! <a href="{{route('team.create')}}">Создать новую запись</a></p>
                @endif
            </div>

            <div class="card-footer clearfix">
                {{ $teams->links()  }}
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
