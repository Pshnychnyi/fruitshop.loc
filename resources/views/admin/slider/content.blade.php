<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if(isset($sliders) && $sliders->isNotEmpty())
                <div class="mb-2">
                    <a href="{{ route('slider.create') }}" class="btn btn-primary">Новая запись</a>
                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Слоган</th>
                        <th>Заголовок</th>
                        <th>Описание</th>
                        <th style="width: 130px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sliders as $slider)
                        <tr>
                            <td>{{$slider->id}}</td>
                            <td>{{$slider->slug}}</td>
                            <td>{{$slider->title}}</td>
                            <td>{{$slider->description}}</td>
                            <td class=text-center>
                                <a href="{{route('slider.edit', ['slider' => $slider->id])}}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                <form class="d-inline" method="POST" action="{{ route('slider.destroy', ['slider' => $slider->id]) }}">
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
                    <p>Категорий пока нет! <a href="{{route('slider.create')}}">Создать новую запись</a></p>
                @endif
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
