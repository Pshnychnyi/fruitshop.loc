<!-- products -->
<div class="product-section mt-150 mb-150">
    <div class="container">

        @if($cats && $cats->isNotEmpty())
        <div class="row">
            <div class="col-md-12">
                <div class="product-filters">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @foreach($cats as $cat)
                        <li data-filter=".{{$cat->title}}">{{$cat->title}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        @if($products && $products->isNotEmpty())
        <div class="row product-lists">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 text-center
                @foreach($product->categories as $item)
                    {{$item->title}}
                @endforeach
                ">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="{{route('main.shop.show', ['shop' => $product->id])}}"><img src="{{ asset('storage/'. $product->img) }}" alt=""></a>
                    </div>
                    <h3>{{$product->title}}</h3>
                    <p class="product-price"><span>Цена за {{$product->per}}</span> {{$product->price}}$ </p>
                    <form action="{{ route('cart.add', ['id' => $product->id]) }}" id="add-to-cart" method="POST">
                        @csrf
                        <input type="hidden" type="number" name="quantity" id="input-quantity" value="1"
                               class="form-control mx-2 w-25">
                        <a type="submit" data-name="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i>В корзину</a>
                    </form>

                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="pagination-wrap">
                    {{$products->links('vendor/pagination/news-pagination')}}
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
<!-- end products -->
