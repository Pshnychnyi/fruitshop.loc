<!-- featured section -->
<div class="feature-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="featured-text">
                    <h2 class="pb-3">Why <span class="orange-text">Fruitkha</span></h2>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-4 mb-md-5">
                            <div class="list-box d-flex">
                                <div class="list-icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="content">
                                    <h3>Home Delivery</h3>
                                    <p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                            <div class="list-box d-flex">
                                <div class="list-icon">
                                    <i class="fas fa-money-bill-alt"></i>
                                </div>
                                <div class="content">
                                    <h3>Best Price</h3>
                                    <p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                            <div class="list-box d-flex">
                                <div class="list-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="content">
                                    <h3>Custom Box</h3>
                                    <p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="list-box d-flex">
                                <div class="list-icon">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                                <div class="content">
                                    <h3>Quick Refund</h3>
                                    <p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end featured section -->

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
@if($teams && $teams->isNotEmpty())
<!-- team section -->
<div class="mt-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3>Наша <span class="orange-text">команда</span></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($teams as $team)
            <div class="col-lg-4 col-md-6">
                <div class="single-team-item">
                    <div class="team-bg team-bg-1"><img src="{{asset('storage/' . $team->img)}}" alt=""></div>
                    <h4>{{$team->name}} <span>{{$team->profession}}</span></h4>
                    <ul class="social-link-team">
                        <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end team section -->
@endif
<!-- testimonail-section -->
@if($reviews && $reviews->isNotEmpty())
    <div class="testimonail-section mt-80 mb-150">
    <div class="container">
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
                                " {{$review->description}} "
                            <div class="last-icon">
                                <i class="fas fa-quote-right"></i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- end testimonail-section -->
