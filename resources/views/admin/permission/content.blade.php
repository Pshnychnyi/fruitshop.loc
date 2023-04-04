<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('permission.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Привелегии</th>
                                    @foreach ($roles as $role)
                                        <th class="text-center">{{ $role->name }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <th>{{ $permission->name }}</th>
                                        @foreach ($roles as $role)
                                            <td class="text-center">
                                                @if ($role->hasPermission($permission->name))
                                                    <input type="checkbox" name="{{ $role->id }}[]"
                                                           value="{{ $permission->id }}" checked>
                                                @else
                                                    <input type="checkbox" name="{{ $role->id }}[]"
                                                           value="{{ $permission->id }}">
                                                @endif

                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Обновить</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
        </div>
    </div>
</section>







