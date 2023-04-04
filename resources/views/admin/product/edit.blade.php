<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if($product)
        <div class="card card-primary">
            <form method="POST" action="{{route('product.update', ['product' => $product->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Наименование</label>
                        <input type="text" name="title" value="{{$product->title}}" class="form-control" id="title" placeholder="Введите наименование">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" class="form-control" id="summernote" placeholder="Введите описание">{{$product->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Цена ($)</label>
                        <input type="number" name="price" value="{{$product->price}}" class="form-control" id="price" placeholder="Введите цену">
                    </div>

                    <div class="form-group">
                        <label>Колличество (за)</label>
                        <select class="form-control" name="per"  data-placeholder="Выберите колличество">
                            @foreach($per as $value)
                                <option {{$value === $product->per ? 'selected' : ''}} value="{{$value}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="discount">Скидка (%)</label>
                        <input type="number" name="discount" value="{{isset($product->discount) ? $product->discount : 0}}" min="0" max="100" class="form-control" id="discount" placeholder="0">
                    </div>
                    @if($categories->isNotEmpty())
                        <div class="form-group">
                            <label>Категории</label>
                            <select class="form-control" name="cats[]" multiple="" id="category" data-placeholder="Выберите категорию">
                                @foreach($categories as $category)
                                    <option {{$product->categories->pluck('id')->contains($category->id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if($products->isNotEmpty())
                        <div class="form-group">
                            <label>Связаные продукты</label>
                            <select class="form-control" name="relates[]" multiple="multiple" id="relates" data-placeholder="Выберите связаные продукты">
                                @foreach($products as $item)
                                    <option {{$product->relatedProducts->pluck('id')->contains($item->id) ? 'selected' : ''}} value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <img class="img-thumbnail" width="200px" src="{{ asset('storage/' . $product->img) }}" alt="">
                    </div>
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
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
        @endif
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

