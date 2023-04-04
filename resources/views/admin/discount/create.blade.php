<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <form method="POST" action="{{route('discount.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Наименование акции</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" placeholder="Введите наименование">
                    </div>
                    <div class="form-group">
                        <label for="percent">Скидка (%)</label>
                        <input type="number" name="percent" value="{{old('percent')}}" min="0" max="100" class="form-control" id="percent" placeholder="0">
                    </div>
                    @if(isset($products) && $products->isNotEmpty())
                        <div class="form-group">
                            <label>Продукты</label>

                            <select class="form-control" name="products[]" id="discount_products" multiple="multiple" id="products" data-placeholder="Выберите продукты">
                                @foreach($products as $product)
                                    <option {{is_array(old('products')) && in_array($product->id, old('products')) ? 'selected' : ''}} value="{{$product->id}}">{{$product->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Дедлайн:</label>
                        <div class="input-group date" id="deadline" data-target-input="nearest">
                            <input type="text" name="deadline" value="{{old('deadline')}}" class="form-control datetimepicker-input" data-target="#deadline" />
                            <div class="input-group-append" data-target="#deadline" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
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
