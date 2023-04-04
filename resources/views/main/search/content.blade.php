<!-- products -->
<div class="product-section mt-100 mb-150">
    <div class="container">

        @if($products && $products->isNotEmpty())
            <div class="row mt-0">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Продукты</span></h3>
                    </div>
                </div>
            </div>
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
                            <p class="product-price"><span>Per {{$product->per}}</span> {{$product->price}}$ </p>
                            <form action="{{ route('cart.add', ['id' => $product->id]) }}" id="add-to-cart" method="POST">
                                @csrf
                                <input type="hidden" type="number" name="quantity" id="input-quantity" value="1"
                                       class="form-control mx-2 w-25">
                                <button type="submit" data-name="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i>В корзину</button>
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
        @if($news && $news->isNotEmpty())


            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Новости</span></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($news as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news">
                            <a href="{{route('main.news.show', ['news' => $item->id])}}">
                                <div class="latest-news-bg news-bg-1"><img height="200" width="350" src="{{asset('storage/' . $item->preview_image)}}" alt=""></div>
                            </a>
                            <div class="news-text-box">
                                <h3><a href="{{route('main.news.show', ['news' => $item->id])}}">{{$item->title}}</a></h3>
                                <p class="blog-meta">
                                    <span class="author"><i class="fas fa-user"></i> {{$item->user->roles->first()->name}}</span>
                                    <span class="date"><i class="fas fa-calendar"></i> {{$item->created_at->format('d F, Y')}}</span>
                                </p>
                                <p class="excerpt">{!!Str::limit($item->preview_text, 150)!!}</p>
                                <a href="{{route('main.news.show', ['news' => $item->id])}}" class="read-more-btn">read more <i
                                        class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
<!-- end products -->
