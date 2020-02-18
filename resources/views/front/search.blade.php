@extends('theme.master')
@section('title', 'Online Courses')
@section('content')

@include('admin.message')

<!-- about-home start -->
<section id="wishlist-home" class="wishlist-home-main-block">
    <div class="container">
        <h4 class="wishlist-home-heading text-white"><i class="fa fa-home"></i>&nbsp;/&nbsp;Courses</h4>
    </div>
</section> 
<!-- about-home end -->

<!-- search start -->
@if(count($courses) > 0)
    <section id="search-block" class="search-main-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="students-bought btm-30">
                        @foreach($courses as $course)
                            <div class="course-bought-block">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <a href="{{ route('user.course.show',$course->id) }}"><img src="{{ asset('images/course/'.$course->preview_image) }}"  alt="student" class="img-fluid"></a>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="categories-popularity-dtl">
                                            <div class="view-heading btm-10"><a href="{{ route('user.course.show',$course->id) }}">{{ $course->title }}</a></div>
                                            <ul>
                                                <li>
                                                    @php
                                                        $data = App\CourseClass::where('course_id', $course->id)->get();
                                                        if(count($data)>0){

                                                            echo count($data);
                                                        }
                                                        else{

                                                            echo "0";
                                                        }
                                                    @endphp Classes 
                                                </li>
                                                <li>All Levels</li>
                                            </ul>
                                            <p>{{  str_limit($course->short_detail, $limit = 125, $end = '..') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="rate text-right">
                                            <ul>
                                                @php
                                                    $currency = App\Currency::first();
                                                @endphp 
                                                @if($course->type == 1)
                                                    @if($course->discount_price == !NULL)
                                                        <li class="rate-r"><s><i class="{{ $currency->icon }}"></i>{{ $course->price }}</s>&nbsp;<i class="{{ $currency->icon }}"></i>{{ $course->discount_price }}</li>
                                                    @else

                                                        <li class="rate-r"><i class="{{ $currency->icon }}"></i>{{ $course->price }}</li>
                                                    @endif

                                                @else
                                                    <li class="rate-r">Free</li>
                                                @endif
                                            </ul>
                                            <div class="rating">
                                                <ul>
                                                  <li>
                                                    {{-- star rating --}}
                                                    <?php 
                                                    $learn = 0;
                                                    $price = 0;
                                                    $value = 0;
                                                    $sub_total = 0;
                                                    $sub_total = 0;
                                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                                    ?> 
                                                    @if(!empty($reviews[0]))
                                                    <?php
                                                    $count =  App\ReviewRating::where('course_id',$course->id)->count();

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
                                                        <div class="pull-left"><p>No Ratings</p></div>
                                                    @endif
                                                  </li>
                                                    
                                                    {{-- overall rating --}}
                                                    <?php 
                                                    $learn = 0;
                                                    $price = 0;
                                                    $value = 0;
                                                    $sub_total = 0;
                                                    $count =  count($reviews);
                                                    $onlyrev = array();

                                                    $reviewcount = App\ReviewRating::where('course_id', $course->id)->where('status',"1")->WhereNotNull('review')->get();

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
                                                        $reviewsrating = App\ReviewRating::where('course_id', $course->id)->first();
                                                    @endphp
                                                    @if(!empty($reviewsrating))
                                                    <li>
                                                        <b>{{ round($overallrating, 1) }}</b>
                                                    </li>
                                                    @endif

                                                </ul>
                                            </div>
                                            <ul>
                                                <li>
                                                    (@php
                                                        $data = App\ReviewRating::where('course_id', $course->id)->get();
                                                        if(count($data)>0){

                                                            echo count($data);
                                                        }
                                                        else{

                                                            echo "0";
                                                        }
                                                    @endphp ratings)
                                                </li> 
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach

                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <section id="search-block" class="search-main-block search-block-no-result">
        <div class="container">
          <h2>Sorry, we couldn't find any results for "{{$searchTerm}}"</h2>
        </div>
    </section>
@endif
<!-- search end -->

@endsection
