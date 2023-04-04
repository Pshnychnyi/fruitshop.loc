@extends('layouts.auth')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
           <div class="h1"><b>FruitShop</b></div>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Регистрация нового пользователя</p>

            <form action="{{route('register')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Введите имя">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Введите Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Введите пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Повторите пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                                c <a href="#">условиями</a> согласен
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">Регистация</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



            <a href="{{route('login')}}" class="text-center">У меня уже есть аккаунт</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->

@endsection
