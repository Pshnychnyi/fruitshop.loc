@if($sliders && $sliders->isNotEmpty())
<div class="homepage-slider">
    <!-- single home slider -->
    @foreach($sliders as $key => $slider)
    <div class="single-homepage-slider homepage-bg-{{$key+1}}">
        <div class="container">
            <div class="row">
                <div class="
                    @if(!($key%3))
                        col-md-12 col-lg-7 offset-lg-1 offset-xl-0
                    @elseif(!(($key+1) % 3))
                    col-lg-10 offset-lg-1 text-right
                    @else
                        col-lg-10 offset-lg-1 text-center
                    @endif
                    ">
                    <div class="hero-text">
                        <div class="hero-text-tablecell">
                            <p class="subtitle">{{$slider->slug}}</p>
                            <h1>{{$slider->title}}</h1>
                            <div class="hero-btns">
                                @if(isset($slider->first_link_name))
                                <a href="{{route($slider->first_link_path)}}" class="boxed-btn">{{$slider->first_link_name}}</a>
                                @endif
                                @if(isset($slider->second_link_name))
                                    <a href="{{route($slider->second_link_path)}}" class="bordered-btn">{{$slider->second_link_name}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
