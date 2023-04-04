<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <form method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Введите имя">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Введите Email">
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
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
