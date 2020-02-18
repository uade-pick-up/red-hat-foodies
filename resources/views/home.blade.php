@extends('theme.master')
@section('title', 'Online Courses')
@section('content')

@include('admin.message')
<!-- categories-tab start-->
<section id="categories-tab" class="categories-tab-main-block">
    <div class="container">
        <div id="categories-tab-slider" class="categories-tab-block owl-carousel">
            @php
                $category = App\Categories::all();
            @endphp
            @foreach($category as $cat)
                @if($cat->status == 1)
                <div class="item categories-tab-dtl">
                    <a href="{{ route('category.page',$cat->id) }}" title="tab"><i class="fa {{ $cat->icon }}"></i>{{ $cat->title }}</a>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
<!-- categories-tab end-->
@php
$sliders = App\Slider::orderBy('id', 'DESC')->get();
@endphp
@if(isset($sliders))
<section id="home-background-slider" class="background-slider-block owl-carousel">
    <div class="item home-slider-img">
        @foreach($sliders as $slider)
        @if($slider->status == 1)
        <div id="home" class="home-main-block" style="background-image: url('{{ asset('images/slider/'.$slider->image) }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="home-dtl">
                            <div class="home-heading text-white">{{ $slider->heading }}</div>
                            <p class="text-white btm-20">{{ $slider->sub_heading }}</div>
                            <div class="search-block">
                                <form action="{{ route('search') }}" class="form-inline search-form" method="GET">
                                    <div class="form-group">
                                        <input type="text" name="searchTerm" id="search" class="form-control" value="{{ isset($searchTerm) ? $searchTerm : '' }}" placeholder="{{ $slider->search_text }}">
                                        
                                        <div class="form-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</section>
@endif

<!-- home end -->
<!-- udemy-work start -->
@php
    $facts = App\SliderFacts::limit(3)->get();
@endphp
@if(isset($facts))
<section id="udemy-work" class="udemy-work-main-block">
    <div class="container">
        <div class="row">
            @foreach($facts as $fact)
            <div class="col-lg-4 col-sm-6">
                <div class="udemy-work-block text-white">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="udemy-work-icon">
                                <i class="fa {{ $fact->icon }}"></i>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="udemy-work-dtl">
                                <div class="work-heading">{{ $fact->heading }}</div>
                                <p>{{ $fact->sub_heading }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- udemy-work end -->
<!-- udemy-courses start -->
@php
    $categories = App\CategorySlider::first();
@endphp
@if(isset($categories))
<section id="udemy-courses" class="udemy-courses-main-block">
    <div class="container">
        <div class="row">
            @php
                $items = App\CourseText::all();
            @endphp
            @if(! $items->isEmpty())
            @foreach($items as $item)
            <div class="col-lg-4">
                <div class="udemy-selection">
                    <div class="selection-heading">{{ $item->heading }}</div>
                    <p>{{ $item->sub_heading }}</p>
                </div>
            </div>
            @endforeach
            @endif
            <div class="col-lg-8">
                <div class="udemy-courses">
                    @php
                        $categories = App\CategorySlider::first();
                    @endphp
                    @if(isset($categories->category_id))
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      @foreach($categories->category_id as $cate)
                        @php
                            $cats= App\Categories::find($cate);
                        @endphp
                        @if($cats->status == 1)
                            <li class="btn nav-item" ><a class="nav-item nav-link" id="home-tab" data-toggle="tab" href="#content-tabs" role="tab" aria-controls="home" onclick="showtab('{{ $cats->id }}')" aria-selected="true">{{ $cats->title }}</a></li>
                        @endif
                      @endforeach
                    </ul>
                    @endif
                </div>
                <div class="tab-content" id="myTabContent">
                    @if(!empty($categories))
                        @foreach($categories->category_id as $cate)
                            <div class="tab-pane fade show active" id="content-tabs" role="tabpanel" aria-labelledby="home-tab">
                                
                                <div id="tabShow">
                                    
                                </div>
                                
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- udemy-courses end -->
<!-- Student start -->
<section id="student" class="student-main-block">
    <div class="container">
        @php
            $cor = App\Course::all();
        @endphp
        @if( ! $cor->isEmpty() )
        <h4 class="student-heading">Featured Courses</h4>
        <div id="student-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($cor as $c)
              @if($c->status == 1 && $c->featured == 1)
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$c->id}}">
                        <div class="view-block">
                            <div class="view-img">
                                <a href="{{ route('user.course.show',$c->id) }}"><img src="{{ asset('images/course/'.$c->preview_image) }}" alt="student" class="img-fluid"></a>
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10"><a href="{{ route('user.course.show',$c->id) }}">{{ str_limit($c->title, $limit = 30, $end = '...') }}</a></div>
                                <p class="btm-10"><a herf="#">by {{ $c->user->fname }}</a></p>
                                <div class="rating">
                                    <ul>
                                        <li>
                                            <?php 
                                            $learn = 0;
                                            $price = 0;
                                            $value = 0;
                                            $sub_total = 0;
                                            $sub_total = 0;
                                            $reviews = App\ReviewRating::where('course_id',$c->id)->get();
                                            ?> 
                                            @if(!empty($reviews[0]))
                                            <?php
                                            $count =  App\ReviewRating::where('course_id',$c->id)->count();

                                            foreach($reviews as $review){
                                                $learn = $review->price*5;
                                                $price = $review->price*5;
                                                $value = $review->value*5;
                                                $sub_total = $sub_total + $learn + $price + $value;
                                            }

                                            $count = ($count*3) * 5;
                                            $rat = $sub_total/$count;
                                            $ratings_var = ($rat*100)/5;
                                            ?>
                            
                                            <div class="pull-left">
                                                <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                                </div>
                                            </div>
                                       
                                             
                                            @else
                                                <div class="pull-left">No Ratings</div>
                                            @endif
                                        </li>
                                        <!-- overall rating-->
                                        <?php 
                                        $learn = 0;
                                        $price = 0;
                                        $value = 0;
                                        $sub_total = 0;
                                        $count =  count($reviews);
                                        $onlyrev = array();

                                        $reviewcount = App\ReviewRating::where('course_id', $c->id)->WhereNotNull('review')->get();

                                        foreach($reviews as $review){

                                            $learn = $review->learn*5;
                                            $price = $review->price*5;
                                            $value = $review->value*5;
                                            $sub_total = $sub_total + $learn + $price + $value;
                                        }

                                        $count = ($count*3) * 5;
                                         
                                        if($count != "")
                                        {
                                            $rat = $sub_total/$count;
                                     
                                            $ratings_var = ($rat*100)/5;
                                   
                                            $overallrating = ($ratings_var/2)/10;
                                        }
                                         
                                        ?>

                                        @php
                                            $reviewsrating = App\ReviewRating::where('course_id', $c->id)->first();
                                        @endphp
                                        @if(!empty($reviewsrating))
                                        <li>
                                            <b>{{ round($overallrating, 1) }}</b>
                                        </li>
                                        @endif
                                      <li>({{ $c->order->count() }})</li> 
                                    </ul>
                                </div>
                                @if( $c->type == 1)
                                    <div class="rate text-right">
                                        <ul>
                                            @php
                                                $currency = App\Currency::first();
                                            @endphp

                                            @if($c->discount_price == !NULL)

                                                <li><a><b><i class="{{ $currency->icon }}"></i>{{ $c->discount_price }}</b></a></li>&nbsp;
                                                <li><a><b><strike><i class="{{ $currency->icon }}"></i>{{ $c->price }}</strike></b></a></li>
                                                
                                            @else
                                                <li><a><b><i class="{{ $currency->icon }}"></i>{{ $c->price }}</b></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                @else
                                    <div class="rate text-right">
                                        <ul>
                                            <li><a><b>Free</b></a></li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div id="prime-next-item-description-block{{$c->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading">{{ $c->title }}</h5>
                                <div class="protip-img">
                                    <a href="{{ route('user.course.show',$c->id) }}"><img src="{{ asset('images/course/'.$c->preview_image) }}" alt="student" class="img-fluid">
                                    </a>
                                </div>

                                <ul class="description-list">
                                    <li>Classes: 
                                        @php
                                            $data = App\CourseClass::where('course_id', $c->id)->get();
                                            if(count($data)>0){

                                                echo count($data);
                                            }
                                            else{

                                                echo "0";
                                            }
                                        @endphp
                                    </li>
                                    <li>
                                        <?php 
                                        $learn = 0;
                                        $price = 0;
                                        $value = 0;
                                        $sub_total = 0;
                                        $count =  count($reviews);
                                        $onlyrev = array();

                                        $reviewcount = App\ReviewRating::where('course_id', $c->id)->where('status',"1")->WhereNotNull('review')->get();

                                    foreach($reviews as $review){

                                        $learn = $review->learn*5;
                                        $price = $review->price*5;
                                        $value = $review->value*5;
                                        $sub_total = $sub_total + $learn + $price + $value;
                                    }

                                    $count = ($count*3) * 5;
                                     
                                    if($count != "")
                                    {
                                        $rat = $sub_total/$count;
                                 
                                        $ratings_var = ($rat*100)/5;
                               
                                        $overallrating = ($ratings_var/2)/10;
                                    }
                                     
                                    ?>

                                    
                                    @if(! $reviews->isEmpty())
                                    <li>
                                        {{ round($overallrating, 1) }} Rating
                                    </li>
                                    @endif
                                    </li>
                                </ul>

                                <div class="main-des">
                                    <p>{{ str_limit($c->detail, $limit = 200, $end = '...') }}</p>
                                </div>
                                <div class="des-btn-block">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            @if($c->type == 1)
                                                @if(Auth::check())
                                                    @if(Auth::User()->role == "admin")
                                                        <div class="protip-btn">
                                                            <a href="{{url('show/coursecontent',$c->id)}}" class="btn btn-secondary" title="course">Go To Course</a>
                                                        </div>
                                                    @else
                                                        @php
                                                            $order = App\Order::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        @endphp
                                                        @if(!empty($order) && $order->status == 1)
                                                            <div class="protip-btn">
                                                                <a href="{{url('show/coursecontent',$c->id)}}" class="btn btn-secondary" title="course">Go To Course</a>
                                                            </div>
                                                        @else
                                                            @php
                                                                $cart = App\Cart::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                            @endphp
                                                            @if(!empty($cart))
                                                                <div class="protip-btn">
                                                                    <form id="demo-form2" method="post" action="{{ route('remove.item.cart',$cart->id) }}">
                                                                            {{ csrf_field() }}
                                                                                
                                                                        <div class="box-footer">
                                                                         <button type="submit" class="btn btn-primary">Remove From Cart</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @else
                                                                <div class="protip-btn">
                                                                    <form id="demo-form2" method="post" action="{{ route('addtocart',['course_id' => $c->id, 'price' => $c->price, 'discount_price' => $c->discount_price ]) }}"
                                                                        data-parsley-validate class="form-horizontal form-label-left">
                                                                            {{ csrf_field() }}

                                                                        <input type="hidden" name="category_id"  value="{{$c->category->id}}" />
                                                                                
                                                                        <div class="box-footer">
                                                                         <button type="submit" class="btn btn-primary">Add To Cart</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @else
                                                    <div class="protip-btn">
                                                        <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add To Cart</a>
                                                    </div>
                                                @endif
                                            @else
                                                 @if(Auth::check())
                                                    @if(Auth::User()->role == "admin")
                                                        <div class="protip-btn">
                                                            <a href="{{url('show/coursecontent',$c->id)}}" class="btn btn-secondary" title="course">Go To Course</a>
                                                        </div>
                                                    @else
                                                        @php
                                                            $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        @endphp
                                                        @if($enroll == NULL)
                                                            <div class="protip-btn">
                                                                <a href="{{url('enroll/show',$c->id)}}" class="btn btn-primary" title="Enroll Now">Enroll Now</a>
                                                            </div>
                                                        @else
                                                            <div class="protip-btn">
                                                                <a href="{{url('show/coursecontent',$c->id)}}" class="btn btn-secondary" title="Cart">Go To Course</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @else
                                                    <div class="protip-btn">
                                                        <a href="{{ route('login') }}" class="btn btn-primary" title="Enroll Now">Enroll Now</a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="protip-wishlist">
                                                <ul>
                                                    @if(Auth::check())
                                                        @php
                                                            $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        @endphp
                                                        @if ($wish == NULL)
                                                            <li class="protip-wish-btn">
                                                                <form id="demo-form2" method="post" action="{{ url('show/wishlist', $c->id) }}" data-parsley-validate 
                                                                    class="form-horizontal form-label-left">
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                                    <input type="hidden" name="course_id"  value="{{$c->id}}" />

                                                                    <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                                </form>
                                                            </li>
                                                        @else
                                                            <li class="protip-wish-btn-two">
                                                                <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $c->id) }}" data-parsley-validate 
                                                                    class="form-horizontal form-label-left">
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                                    <input type="hidden" name="course_id"  value="{{$c->id}}" />

                                                                    <button class="wishlisht-btn" title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                                </form>
                                                            </li>
                                                        @endif 
                                                    @else
                                                        <li class="protip-wish-btn"><a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
              @endif
            @endforeach
        </div>
        @endif
    </div>
</section>
<!-- Students end -->
<!-- recommendations start -->
<section id="border-recommendation" class="border-recommendation">
    @php
        $gets = App\GetStarted::first();
    @endphp
    @if(isset($gets)) 
    <div class="top-border"></div>
    <div class="recommendation-main-block  text-center" style="background-image: url('{{ asset('images/getstarted/'.$gets->image) }}')">
        <div class="container">
            <h3 class="text-white">{{ $gets->heading }}</h3>
            <p class="text-white btm-20">{{ $gets->sub_heading }}</p>
            @if($gets->button_txt == !NULL)
            <div class="recommendation-btn text-white">
                <a href="{{ url('/') }}" class="btn btn-primary " title="search">{{ $gets->button_txt }}</a>
            </div>
            @endif 
        </div>
    </div>
    @endif
</section>
<!-- recommendations end -->
<!-- categories start -->
@php
    $topcats = App\Categories::all();
@endphp
@if(!$topcats->isEmpty())
<section id="categories" class="categories-main-block">
    <div class="container">
        
        <h3 class="categories-heading btm-30">Top categories</h3>
        <div class="row">
            @foreach($topcats as $t)
            @if($t->status == 1)
            <div class="col-lg-3 col-sm-6">
                <div class="categories-block">
                    <ul>
                        <li><a href="#" title="{{ $t->title }}"><i class="fa {{ $t->icon }}"></i>
                        </a></li>
                        <li><a href="{{ route('category.page',$t->id) }}">{{ $t->title }}</a></li>
                    </ul>
                </div>      
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- categories end -->
<!-- testimonial start -->
 @php
    $testi = App\Testimonial::all();
@endphp
@if( ! $testi->isEmpty() )
<section id="testimonial" class="testimonial-main-block">
    <div class="container">
        <h3 class="btm-30">What our students have to say</h3>
        <div id="testimonial-slider" class="testimonial-slider-main-block owl-carousel">
            
            @foreach($testi as $tes)
             @if($tes->status == 1)
            <div class="item testimonial-block">
                <ul>
                    <li><img src="{{ asset('images/testimonial/'.$tes->image) }}" alt="blog"></li>
                    <li><h5 class="testimonial-heading">{{ $tes->client_name }}</h5></li>
                </ul>
                <p>{{ strip_tags(str_limit($tes->details , $limit = 200, $end = '...')) }}</p>
            </div>
             @endif
            @endforeach
        </div> 
        
    </div>
</section>
@endif

@php
    $trusted = App\Trusted::all();
@endphp
@if( !$trusted->isEmpty() )
<section id="trusted" class="trusted-main-block">
    <div class="container">
        <div class="patners-block">
            
            <h6 class="patners-heading text-center btm-40">Trusted by companies of all sizes</h6>
            <div id="patners-slider" class="patners-slider owl-carousel">
                @foreach($trusted as $trust)
                    @if($trust->status == 1)
                    <div class="item-patners-img">
                        <a href="{{ $trust->url }}" target="_blank"><img src="{{ asset('images/trusted/'.$trust->image) }}" class="img-fluid" alt="patners-1"></a>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

@endsection

@section('custom-script')
<script>
    (function($) {
      "use strict";
        $(function() {
           $( "#home-tab" ).trigger( "click" );
        });
    })(jQuery);

    function showtab(id){
        $.ajax({
            type : 'GET',
            url  : '{{ url('/tabcontent') }}/'+id,
            dataType  : 'html',
            success : function(data){

                $('#tabShow').html('');
                $('#tabShow').append(data);
            }
        });
    }
</script>

@endsection
