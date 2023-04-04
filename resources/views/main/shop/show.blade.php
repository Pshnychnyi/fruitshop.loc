<!-- single product -->
<div class="single-product mt-150 mb-150">
    <div class="container">
        @if($product)
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        <img src="{{ asset('storage/' . $product->img) }}" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3>{{$product->title}}</h3>
                        <p class="single-product-pricing"><span>За {{$product->per}}</span> ${{$product->price}}</p>
                        {!! $product->description !!}
                        <div class="single-product-form">
                            <form action="{{ route('cart.add', ['id' => $product->id]) }}" id="add-to-cart">
                                @csrf
                                <input type="number" name="quantity" placeholder="1" min="1">
                                <a type="submit" data-name="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i>В корзину</a>
                            </form>

                            @if($product->categories && $product->categories->isNotEmpty())
                            <p><strong>Категории: </strong>
                                @foreach($product->categories as $category)
                                    {{$category->title}}
                                @endforeach
                            </p>
                            @endif
                        </div>
                        <h4>Share:</h4>
                        <ul class="product-share">
                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- end single product -->
@if($product->relatedProducts && $product->relatedProducts->isNotEmpty())
<!-- more products -->
<div class="more-products mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Связаные</span>  товары</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($product->relatedProducts as $item)
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="{{route('main.shop.show', ['shop' => $item->id])}}"><img src="{{ asset('storage/' . $item->img) }}" alt=""></a>
                    </div>
                    <h3>{{$item->title}}</h3>
                    <p class="product-price"><span>Цена за {{$item->per}}</span> {{$item->price}}$ </p>
                    <form action="{{ route('cart.add', ['id' => $product->id]) }}" id="add-to-cart">
                        @csrf
                        <input type="hidden" name="quantity" placeholder="1" min="1">
                        <a type="submit" data-name="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i>В корзину</a>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end more products -->
@endif
