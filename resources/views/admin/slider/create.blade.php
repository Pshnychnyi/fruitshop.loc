<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <form method="POST" action="{{route('slider.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="slug">Слоган</label>
                        <input type="text" name="slug" value="{{old('slug')}}" class="form-control" id="slug" placeholder="Введите слоган">
                    </div>
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" placeholder="Введите наименование">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <input type="text" name="description" value="{{old('description')}}" class="form-control" id="description" placeholder="Введите описание">
                    </div>
                    <div class="form-group">
                        <label for="first_link_name">Наименование первой ссылки</label>
                        <input type="text" name="first_link_name" value="{{old('first_link_name')}}" class="form-control" id="first_link_name" placeholder="Введите наименование">
                    </div>
                    @if($links)
                    <div class="form-group">
                        <label for="first_link_name">Путь первой ссылки</label>
                        <select class="form-control" name="first_link_path" id="first_link_path">
                            @foreach($links as $link)
                                <option value="{{$link->id}}" {{old('first_link_path') == $link->id ? 'selected' : ''}}>{{$link->title}}</option>
@endforeach
</select>
</div>
@endif

<div class="form-group">
<label for="second_link_name">Наименование второй ссылки</label>
<input type="text" name="second_link_name" value="{{old('second_link_name')}}" class="form-control" id="second_link_name" placeholder="Введите наименование">
</div>
@if($links)
<div class="form-group">
<label for="second_link_name">Путь второй ссылки</label>
<select class="form-control" name="second_link_path" id="second_link_path">
@foreach($links as $link)
<option value="{{$link->id}}" {{old('second_link_path') == $link->id ? 'selected' : ''}}>{{$link->title}}</option>
@endforeach
</select>
</div>
@endif
</div>

<div class="card-footer">
<button type="submit" class="btn btn-primary">Создать</button>
</div>
</form>
</div>
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
