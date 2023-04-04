<!-- features list section -->
<div class="list-section pt-80 pb-80">
    <div class="container">

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="list-box d-flex align-items-center">
                    <div class="list-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="content">
                        <h3>Бесплатная доставка</h3>
                        <p>На заказы больше $75</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="list-box d-flex align-items-center">
                    <div class="list-icon">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <div class="content">
                        <h3>24/7 Поддержка</h3>
                        <p>Поддерживаем в течение всего дня</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="list-box d-flex justify-content-start align-items-center">
                    <div class="list-icon">
                        <i class="fas fa-sync"></i>
                    </div>
                    <div class="content">
                        <h3>Возврат</h3>
                        <p>Возврат в течение 3 дней!</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end features list section -->

<!-- product section -->
<div class="product-section mt-150 mb-150">
    <div class="container">
        @if($products && $products->isNotEmpty())
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Наши</span> Продукты</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="{{route('main.shop.show', ['shop' => $product->id])}}"><img src="{{asset('storage/' . $product->img)}}" alt=""></a>
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
        @endif
    </div>
</div>
<!-- end product section -->

<!-- cart banner section -->

<section class="cart-banner pt-100 pb-100">
    <div class="container">
        @if($discountProduct)
        <div class="row clearfix">
            <!--Image Column-->
            <div class="image-column col-lg-6">
                <div class="image">
                    <div class="price-box">
                        <div class="inner-price">
                                <span class="price">
                                    <strong>{{$discountProduct->discount->percent}}%</strong> <br> за {{$discountProduct->per}}
                                </span>
                        </div>
                    </div>
                    <img src="{{asset('storage/'. $discountProduct->img)}}" alt="">
                </div>
            </div>
            <!--Content Column-->
            <div class="content-column col-lg-6">
                <h3><span class="orange-text">{{$discountProduct->discount->title}}</span></h3>
                <h4>{{$discountProduct->title}}</h4>
                <div class="text">{!! Str::limit($discountProduct->description, 500) !!}</div>
                <!--Countdown Timer-->
                <div class="time-counter"><div class="time-countdown clearfix" data-countdown="{{$discountProduct->discount->deadline}}"><div class="counter-column"><div class="inner"><span class="count">00</span>Days</div></div> <div class="counter-column"><div class="inner"><span class="count">00</span>Hours</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Mins</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Secs</div></div></div></div>
                <form action="{{ route('cart.add', ['id' => $discountProduct->id]) }}" id="add-to-cart" method="POST">
                    @csrf
                    <input type="hidden" type="number" name="quantity" id="input-quantity" value="1"
                           class="form-control mx-2 w-25">
                    <a type="submit" data-name="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i>В корзину</a>
                </form>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- end cart banner section -->

<!-- testimonail-section -->

<div class="testimonail-section mt-150 mb-150">
    <div class="container">
        @if($reviews && $reviews->isNotEmpty())
        <div class="row">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="testimonial-sliders">
                    @foreach($reviews as $review)
                    <div class="single-testimonial-slider">
                        <div class="client-avater">
                            <img src="{{asset('storage/' . $review->img)}}" alt="">
                        </div>
                        <div class="client-meta">
                            <h3>{{$review->title}} <span>{{$review->profession}}</span></h3>
                            <p class="testimonial-body">
                                " {!! Str::limit($review->description, 255) !!}  "
                            </p>
                            <div class="last-icon">
                                <i class="fas fa-quote-right"></i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- end testimonail-section -->

<!-- advertisement section -->
<div class="abt-section mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="abt-bg">
                    <a href="https://www.youtube.com/watch?v=F-Dur7Ps1vo" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="abt-text">
                    <p class="top-sub">Работаем с 1999 года</p>
                    <h2>Мы - это <span class="orange-text">FruitShop</span></h2>
                    <p>Etiam vulputate ut augue vel sodales. In sollicitudin neque et massa porttitor vestibulum ac vel nisi. Vestibulum placerat eget dolor sit amet posuere. In ut dolor aliquet, aliquet sapien sed, interdum velit. Nam eu molestie lorem.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente facilis illo repellat veritatis minus, et labore minima mollitia qui ducimus.</p>
                    <a href="{{route('main.about')}}" class="boxed-btn mt-4">Подробнее</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end advertisement section -->

<!-- shop banner -->
@if(isset($discount))
<section class="shop-banner">
    <div class="container">
        <h3>{{$discount->title}} продолжается! <br> с большой <span class="orange-text">Скидкой...</span></h3>
        <div class="sale-percent"><span>Скидка! <br> до</span>{{$discount->percent}}% <span></span></div>
        <a href="{{route('main.shop')}}" class="cart-btn btn-lg">В магазин</a>
    </div>
</section>
@endif
<!-- end shop banner -->

<!-- latest news -->
<div class="latest-news pt-150 pb-150">
    <div class="container">
        @if($news && $news->isNotEmpty())
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Наши</span> Новости</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($news as $item)
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-news">
                    <a href="{{route('main.news.show', ['news' => $item->id])}}"><div class="latest-news-bg news-bg-1"><img height="200" width="350" src="{{ asset('storage/' . $item->preview_image) }}" alt=""></div></a>
                    <div class="news-text-box">
                        <h3><a href="{{route('main.news.show', ['news' => $item->id])}}">{{$item->title}}</a></h3>
                        <p class="blog-meta">
                            <span class="author"><i class="fas fa-user"></i> {{$item->user->roles->first()->name}}</span>
                            <span class="date"><i class="fas fa-calendar"></i> {{$item->created_at->format('d F, Y')}}</span>
                        </p>
                        <p class="excerpt">{!! Str::limit($item->preview_text, 150) !!}.</p>
                        <a href="{{route('main.news.show', ['news' => $item->id])}}" class="read-more-btn">Подробнее <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="{{route('main.news')}}" class="boxed-btn">Больше новостей</a>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- end latest news -->
