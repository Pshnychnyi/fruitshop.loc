<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Наименование</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" placeholder="Введите наименование">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" class="form-control" id="summernote" placeholder="Введите описание">{{old('title')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Цена ($)</label>
                        <input type="number" name="price" value="{{old('price')}}" class="form-control" id="price" placeholder="Введите цену">
                    </div>
                    @if($per)
                    <div class="form-group">
                        <label>Колличество (за)</label>
                        <select class="form-control" name="per"  data-placeholder="Выберите колличество">
                            @foreach($per as $value)
                            <option {{$value === old('per') ? 'selected' : ''}} value="{{$value}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if($categories->isNotEmpty())
                    <div class="form-group">
                        <label>Категории</label>
                        <select class="form-control" name="cats[]" multiple="" id="category" data-placeholder="Выберите категорию">
                            @foreach($categories as $category)
                                <option {{is_array(old('cats')) && in_array($category->title, old('cats')) ? 'selected' : ''}} value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if($products->isNotEmpty())
                    <div class="form-group">
                        <label>Связаные продукты</label>
                        <select class="form-control" name="relates[]" multiple="multiple" id="relates" data-placeholder="Выберите связаные продукты">
                            @foreach($products as $product)
                                <option {{is_array(old('relates')) && in_array($product->title, old('relates')) ? 'selected' : ''}} value="{{$product->id}}">{{$product->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="img">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="img" class="custom-file-input" id="img">
                                <label class="custom-file-label" for="img">Выбрать файл</label>
                            </div>
                        </div>
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
