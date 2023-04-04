@extends('layouts.auth')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <div class="h1"><b>FruitShop</b></div>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Войдите для начала сессии</p>

            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Введите Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Введите Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Войти</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="forgot-password.html">Забыл пароль</a>
            </p>
            <p class="mb-0">
                <a href="{{route('register')}}" class="text-center">Регистрация нового пользователя</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
