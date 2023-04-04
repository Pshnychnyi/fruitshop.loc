@extends('layouts.main')
@section('navigation')
    {!! $navigation !!}
@endsection
@section('breadcrumbs')
    {!! $breadcrumbs !!}
@endsection
@section('content')
    <!-- error section -->
    <div class="full-height-section error-section">
        <div class="full-height-tablecell">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="error-text">
                            <i class="far fa-sad-cry"></i>
                            <h1>Упс! Не найдено.</h1>
                            <p>Страница по вашему запросу не найдена.</p>
                            <a href="{{route('main.index')}}" class="boxed-btn">На главную</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end error section -->
@endsection

@section('footer')
    @include('main.footer')
@endsection





