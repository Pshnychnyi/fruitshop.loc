<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if($user)
        <div class="card card-primary">
            <form method="POST" action="{{route('user.update', ['user' => $user->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" name="name" value="{{$user->name}}" class="form-control" id="name" placeholder="Введите имя">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="{{$user->email}}" class="form-control" id="email" placeholder="Введите Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Введите пароль">
                    </div>
                    <div class="form-group">
                        <label for="password">Подтверждение пароля</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Подтвердите пароль">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>

        </div>
        @else
            <div>
                <p>Записи с таким id не существует</p>
            </div>

        @endif
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
