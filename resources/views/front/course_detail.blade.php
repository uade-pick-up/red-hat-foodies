@extends('theme.master')
@section('title', "$course->title")
@section('content')

@include('admin.message')
<!-- course detail header start -->
<section id="about-home" class="about-home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="about-home-block text-white">
                    <h1 class="about-home-heading text-white">{{ $course->title }}</h1>
                    <p>{{ $course->short_detail }}</p> 
                    <ul>
                        <li>
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
                                <div class="no-rating">
                                    No Rating
                                </div>
                            @endif
                        </li>

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

                        
                        @if(! $reviews->isEmpty())
                        <li>
                            {{ round($overallrating, 1) }} rating
                        </li>
                        @endif
                        <li>
                            (@php
                                $data = App\ReviewRating::where('course_id', $course->id)->get();
                                if(count($data)>0){

                                    echo count($data);
                                }
                                else{

                                    echo "0";
                                }
                            @endphp reviews)
                        </li>
                        <li>
                            @php
                                $data = App\Order::where('course_id', $course->id)->get();
                                if(count($data)>0){

                                    echo count($data);
                                }
                                else{

                                    echo "0";
                                }
                            @endphp 
                            students enrolled
                        </li>
                    </ul>
                    <ul>
                        <li><a href="#" title="about">Created by: {{ $course->user->fname }} </a></li>
                        <li><a href="#" title="about">Last Updated {{ date('jS F Y', strtotime($course->updated_at)) }}</a></li>
                        @if($course->language_id == !NULL)
                        <li><a href="#" title="about"><i class="fa fa-comment"></i></a> {{ $course->language->name }}</li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- course preview -->
            <div class="col-lg-4">
                <div class="about-home-icon text-white text-right">
                    <ul>
                        @if(Auth::check())
                            @php
                                $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                            @endphp
                            @if ($wish == NULL)
                                <li class="about-icon-one">
                                    <form id="demo-form2" method="post" action="{{ url('show/wishlist', $course->id) }}" data-parsley-validate 
                                        class="form-horizontal form-label-left">
                                        @csrf

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                        <input type="hidden" name="course_id"  value="{{$course->id}}" />

                                        <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i>Wishlist</button>
                                    </form>
                                </li>
                            @else
                                <li class="about-icon-two">
                                    <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $course->id) }}" data-parsley-validate 
                                        class="form-horizontal form-label-left">
                                        @csrf

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                        <input type="hidden" name="course_id"  value="{{$course->id}}" />

                                        <button class="wishlisht-btn" title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i>Wishlisted</button>
                                    </form>
                                </li>
                            @endif 
                        @else
                            <li class="about-icon-one"><a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i>Wishlist</a></li>
                        @endif
                    </ul>
                </div>
                
                <div class="about-home-product">
                    <div class="video-item hidden-xs">
                        <script type="text/javascript">
                        @if($course->video !="")
                        var video_url = '<iframe src="{{ asset('video/preview/'.$course->video) }}" frameborder="0" allowfullscreen></iframe>';
                        @endif
                        @if($course->url !="")
                        var video_url = '<iframe src="{{ str_replace('watch?v=','embed/',$course->url) }}" frameborder="0" allowfullscreen></iframe>';
                        @endif
                        </script>
                        <div class="video-device">
                            <img src="{{ asset('images/course/'.$course->preview_image) }}" class="bg_img img-fluid" alt="Background">
                            <div class="video-preview">
                                <a href="javascript:void(0);" class="btn-video-play"><i class="fa fa-play"></i></a>
                            </div>
                        </div>
                    </div>
               
                     
                    <div class="about-home-dtl-training">
                        <div class="about-home-dtl-block btm-10">
                        @if($course->type == 1)
                            <div class="about-home-rate">
                                <ul>
                                    @php
                                        $currency = App\Currency::first();
                                    @endphp
                                    @if($course->discount_price == !NULL) 
                                        <li><i class="{{ $currency->icon }}"></i>{{ $course->discount_price }}</li>
                                        <li><span><s><i class="{{ $currency->icon }}"></i>{{ $course->price }}</s></span></li>
                                    @else
                                        <li><i class="{{ $currency->icon }}"></i>{{ $course->price }}</li>
                                    @endif

                                </ul>
                            </div>
                            @if(Auth::check())
                                @if(Auth::User()->role == "admin")
                                    <div class="about-home-btn btm-20">
                                        <a href="{{url('show/coursecontent',$course->id)}}" class="btn btn-secondary" title="course">Go To Course</a>
                                    </div>
                                @else
                                    @php
                                        $order = App\Order::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                                    @endphp
                                    @if(!empty($order) && $order->status == 1)
                                       
                                        <div class="about-home-btn btm-20">
                                            <a href="{{url('show/coursecontent',$course->id)}}" class="btn btn-secondary" title="course">Go To Course</a>
                                        </div>

                                    @else
                                        @php
                                            $cart = App\Cart::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                                        @endphp
                                        @if(!empty($cart))
                                            <div class="about-home-btn btm-20">
                                                <form id="demo-form2" method="post" action="{{ route('remove.item.cart',$cart->id) }}">
                                                    {{ csrf_field() }}
                                                            
                                                    <div class="box-footer">
                                                     <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Remove From Cart</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @else
                                            <div class="about-home-btn btm-20">
                                                <form id="demo-form2" method="post" action="{{ route('addtocart',['course_id' => $course->id, 'price' => $course->price, 'discount_price' => $course->discount_price ]) }}"
                                                    data-parsley-validate class="form-horizontal form-label-left">
                                                        {{ csrf_field() }}

                                                    <input type="hidden" name="category_id"  value="{{$course->category->id}}" />
                                                            
                                                    <div class="box-footer">
                                                     <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add To Cart</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @else
                                <div class="about-home-btn btm-20">
                                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add To Cart</a>
                                </div>
                            @endif
                        @else
                            <div class="about-home-rate">
                                <ul>
                                    <li>Free</li>
                                </ul>
                            </div>
                            @if(Auth::check())
                                @if(Auth::User()->role == "admin")
                                    <div class="about-home-btn btm-20">
                                        <a href="{{url('show/coursecontent',$course->id)}}" class="btn btn-secondary" title="course">Go To Course</a>
                                    </div>
                                @else
                                    @php
                                        $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                                    @endphp
                                    @if($enroll == NULL)
                                        <div class="about-home-btn btm-20">
                                            <a href="{{url('enroll/show',$course->id)}}" class="btn btn-primary" title="Enroll Now">Enroll Now</a>
                                        </div>
                                    @else
                                        <div class="about-home-btn btm-20">
                                            <a href="{{url('show/coursecontent',$course->id)}}" class="btn btn-secondary" title="Cart">Go To Course</a>
                                        </div>
                                    @endif
                                @endif
                            @else
                                <div class="about-home-btn btm-20">
                                    <a href="{{ route('login') }}" class="btn btn-primary" title="Enroll Now">Enroll Now</a>
                                </div>
                            @endif
                        @endif
                            <div class="about-home-includes-list btm-40">
                                <ul class="btm-40">
                                    @if($courseinclude->isNotEmpty())
                                        <li><span>Course Includes</span></li>
                                        @foreach($course->include as $in)
                                            @if($in->status ==1)
                                                <li><i class="fa {{ $in->icon }}"></i>{{ str_limit($in->detail, $limit = 50, $end = '...') }}</li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <hr>
                        </div>
                        <div class="about-home-training">
                            <span>Training 5 or more people?</span>
                            <p>Get your team access to Udemy's top 3,000+ courses anytime, anywhere.</p>
                            <div class="about-home-coupon"><a href="#" title="coupon?"> Try Udemy for Business</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- course header end -->
<!-- course detail start -->
<section id="about-product" class="about-product-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if($whatlearns->isNotEmpty())
                    <div class="product-learn-block">
                        <h3 class="product-learn-heading">What you'll learn</h2>
                        <div class="row">
                            @foreach($course->whatlearns as $wl)
                            @if($wl->status ==1)
                            <div class="col-lg-6 col-md-6">
                                <div class="product-learn-dtl">
                                    <ul>
                                        <li><i class="fa fa-check"></i>{{ str_limit($wl->detail, $limit = 120, $end = '...') }}</li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="requirements">
                    <h3>Requirements</h3>
                    <ul>
                        <li>{{ $course->requirement }}</li>
                    </ul>
                </div>
                <div class="description-block btm-30">
                    <h3>Description</h3>
                    <p>{{ $course->detail }}</p>
                </div>

                @auth
                @php
                    $alreadyrated = App\ReviewRating::where('course_id', $course->id)->limit(1)->first();
                @endphp
                @if($alreadyrated == !NULL)
                @if($alreadyrated->featured == 1)
                    <div class="featured-review btm-40">
                        <h3>Featured Review</h3>
                        <?php

                            $user_count = count([$alreadyrated]);
                            $user_sub_total = 0;
                            $user_learn_t = $alreadyrated->learn * 5;
                            $user_price_t = $alreadyrated->price * 5;
                            $user_value_t = $alreadyrated->value * 5;
                            $user_sub_total = $user_sub_total + $user_learn_t + $user_price_t + $user_value_t;

                            $user_count = ($user_count * 3) * 5;
                            $rat1 = $user_sub_total / $user_count;
                            $ratings_var1 = ($rat1 * 100) / 5;

                        ?>
                        @if(isset($alreadyrated))
                        
                        @foreach($coursereviews as $rating)
                        @if($rating->review == !null && $rating->featured == 1)
                        <div class="featured-review-block">
                            <div class="row">
                                <div class="col-lg-1 col-sm-1 col-1">
                                    <div class="featured-review-img">
                                        <div class="review-img text-white">
                                        {{ $rating->user->fname[0] }}{{ $rating->user->lname[0]  }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-sm-11 col-11">
                                    <div class="featured-review-img-dtl">
                                        <div class="review-img-name"><span>{{ $rating->user->fname }}</span></div>
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var1; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="year btm-20">{{ date('jS F Y', strtotime($rating->created_at)) }}</div>
                                    </div>
                                </div>
                            </div>
                            <p class="btm-20">{{ $rating->review }}</p>
                            <div class="review">Was this review helpful?
                                @php
                                $help = App\ReviewHelpful::where('user_id', Auth::User()->id)->where('review_id', $rating->id)->first();
                                @endphp
                              
                                @if($help == !NULL)
                                    <div class="helpful">
                                        <form  method="post" action="{{route('helpful.delete', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-link lft-7 rgt-10 yes-submitted"><i class="fa fa-check"></i> Yes</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="helpful">
                                        <form  method="post" action="{{route('helpful', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                        <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                        <input type="hidden" name="helpful"  value="yes" />
                                        
                                          <button type="submit" class="btn btn-link lft-7 rgt-10 ">Yes</button>
                                        </form>
                                    </div>
                                @endif

                                <a href="#" data-toggle="modal" data-target="#myModalreport"  title="report">Report</a>

                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                @endif
                @endif
                @endauth

                @if($coursechapters->isNotEmpty())
                <div class="course-content-block btm-30">
                    <h3>Course content</h3>
                    <div class="faq-block">
                        <div class="faq-dtl">
                            <div id="accordion" class="second-accordion">
                                @foreach($coursechapters as $chapter)
                                @if($chapter->status == 1)
                                <div class="card">
                                    <div class="card-header" id="headingTwo{{ $chapter->id }}">
                                        <div class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo{{ $chapter->id }}" aria-expanded="true" aria-controls="collapseTwo">
                                               
                                                <div class="row">
                                                <div class="col-lg-6 col-6">
                                                    {{ $chapter->chapter_name }}
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        @php
                                                            $classone = App\CourseClass::where('coursechapter_id', $chapter->id)->get();
                                                            if(count($classone)>0){

                                                                echo count($classone);
                                                            }
                                                            else{

                                                                echo "0";
                                                            }
                                                        @endphp
                                                        Classes
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            </button>
                                        </div>

                                    </div>
                                    <div id="collapseTwo{{ $chapter->id }}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        
                                        <div class="card-body">
                                            <table class="table">  
                                                <tbody>
                                                    @foreach($courseclass as $class)
                                                    @if($class->coursechapter_id == $chapter->id)
                                                    <tr>
                                                        <th class="class-icon">
                                                        @if($class->type =='video' )
                                                        <a href="#" title="Course"><i class="fa fa-play-circle"></i></a>
                                                        @endif
                                                        @if($class->type =='image' )
                                                        <a href="#" title="Course"><i class="fas fa-image"></i></a>
                                                        @endif
                                                        @if($class->type =='pdf' )
                                                        <a href="#" title="Course"><i class="fas fa-file-pdf"></i></a>
                                                        @endif
                                                        @if($class->type =='zip' )
                                                        <a href="#" title="Course"><i class="far fa-file-archive"></i></a>
                                                        @endif
                                                        </th>

                                                        <td><a href="#" title="Course">{{ $class->title }}</a></td>
                                                        
                                                        <td class="txt-rgt">
                                                        @if($class->type =='video')
                                                        {{ $class->duration }}min
                                                        @else
                                                        {{ $class->size }}mb
                                                        @endif
                                                        </td>
                                                        
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="students-bought btm-30">
                    <h3>Recent Courses</h3>
                    @php
                        $items = App\Course::orderBy('created_at','desc')->limit(5)->get()
                    @endphp
                    @foreach($items as $item)
                    <div class="course-bought-block">
                        <div class="row">
                            <div class="col-lg-7 col-md-6 col-12">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4 col-5">
                                        <div class="course-bought-img">
                                            <a href="{{ route('user.course.show',$item->id) }}"><img src="{{ asset('images/course/'.$item->preview_image) }}" class="img-fluid" alt="blog"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-8 col-7">
                                        <div class="course-name"><a href="{{ route('user.course.show',$item->id) }}">{{ str_limit($item->title, $limit = 35, $end = '...') }}</a></div>
                                        <div class="course-update">Updated {{ date('jS F Y', strtotime($item->updated_at)) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-1 col-4">
                                <div class="course-user">
                                    <ul>
                                        <li><i class="fa fa-user"></i></li>
                                        <li>{{ $item->order->count() }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-4">
                                @if($item->type==1)
                                    @php
                                        $currency1 = App\Currency::first();
                                    @endphp
                                    @if($item->discount_price == !NULL) 
                                        <div class="course-currency txt-rgt">
                                            <ul>
                                                <li class="rate"><i class="{{ $currency1->icon }}"></i>{{ $item->discount_price }}</li>
                                                <li class="rate"><s><i class="{{ $currency1->icon }}"></i>{{ $item->price }}</s></li>
                                            </ul>
                                        </div>
                                    @else
                                        <div class="course-currency txt-rgt">
                                            <ul>
                                                <li><i class="{{ $currency1->icon }}"></i>{{ $item->price }}</li>
                                            </ul>
                                        </div>
                                    @endif
                                @else
                                    <div class="course-currency txt-rgt">
                                        <ul>
                                            <li>Free</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-1 col-md-2 col-4">
                                <div class="course-rate txt-rgt">
                                    <ul>
                                        <li>
                                        @if (Auth::check())
                                        @php
                                            $wishtt = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $item->id)->first();
                                        @endphp
                                        @if ($wishtt == NULL)
                                            <div class="heart">
                                                <form id="demo-form2" method="post" action="{{ url('show/wishlist', $item->id) }}" data-parsley-validate 
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$item->id}}" />

                                                    <button class="wishlisht-btn heart" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="heart-two">
                                                <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $item->id) }}" data-parsley-validate 
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::user()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$item->id}}" />

                                                    <button class="wishlisht-btn heart"  title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @endif
                                        @else
                                            <div class="heart"><a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a></div>
                                        @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="about-instructor-block">
                    <h3>About the Instructor</h3>
                    
                    <div class="about-instructor btm-40">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <div class="instructor-img btm-30">
                                    @if($course->user->user_img != null || $course->user->user_img !='')
                                      <img src="{{ asset('images/user_img/'.$course->user->user_img) }}" class="img-fluid"  alt="instructor" >
                                    @else
                                      <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="instructor">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <div class="instructor-block">
                                    <div class="instructor-name btm-10"><a href="#" title="instructor-name">{{ $course->user->fname }}</a></div>
                                    <div class="instructor-post btm-20">About the Instructor</div>
                                    <p>{{ strip_tags($course->user->detail) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if(! $reviews->isEmpty())
                <div class="student-feedback btm-40">
                    <h3 class="student-feedback-heading">Student feedback</h3>
                    <div class="student-feedback-block">

                        <div class="rating">
                            <?php 
                                $learn = 0;
                                $price = 0;
                                $value = 0;
                                $sub_total = 0;
                                $count =  count($reviews);
                                $onlyrev = array();

                                $reviewcount = App\ReviewRating::where('course_id',1)->where('status',"1")->WhereNotNull('review')->get();

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

                            <div class="rating-num">{{ round($overallrating, 1) }}</div>
                            
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
                                    $learn = $review->learn*5;
                                    $price = $review->price*5;
                                    $value = $review->value*5;
                                    $sub_total = $sub_total + $learn + $price + $value;
                                }

                                $count = ($count*3) * 5;
                                $rat = $sub_total/$count;
                                $ratings_var = ($rat*100)/5;
                                ?>
                                <div class="pull-left">
                                    <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                    </div>
                                </div>
                            @else
                                <div class="pull-left">
                                    <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                    </div>
                                </div>
                            @endif
                            <div class="rating-users">Course Rating</div>
                        </div>
                        <div class="histo">
                            <div class="three histo-rate">
                                <span class="histo-star">
                                    <?php 
                                    $learn = 0;
                                    $total = 0;
                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                    ?> 
                                    @if(!empty($reviews[0]))
                                        <?php
                                        $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                        foreach($reviews as $review){
                                            $learn = $review->learn*5;
                                            $total = $total + $learn;
                                        }

                                        $count = ($count*1) * 5;
                                        $rat = $total/$count;
                                        $ratings_var = ($rat*100)/5;
                                        ?>
                        
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                     
                                    @else
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                                <span class="histo-percent">
                                    <a href="#" title="rate">{{ round($ratings_var) }}%</a>
                                </span>
                                <span class="bar-block">
                                    <span id="bar-three" style=" width:{{ $ratings_var }}%;" class="bar bar-clr bar-radius">&nbsp;</span> 
                                </span>
                            </div>
                            <div class="two histo-rate">
                                <span class="histo-star">
                                    <?php 
                                    $price = 0;
                                    $total = 0;
                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                    ?> 
                                    @if(!empty($reviews[0]))
                                        <?php
                                        $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                        foreach($reviews as $review){
                                            $price = $review->price*5;
                                            $total = $total + $price;
                                        }

                                        $count = ($count*1) * 5;
                                        $rat = $total/$count;
                                        $ratings_var = ($rat*100)/5;
                                        ?>
                        
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                     
                                    @else
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                                <span class="histo-percent">
                                    <a href="#" title="rate">{{ round($ratings_var) }}%</a>
                                </span>
                                <span class="bar-block">
                                    <span id="bar-two" style="width: {{ $ratings_var }}%" class="bar bar-clr bar-radius">&nbsp;</span> 
                                </span>
                            </div>
                            <div class="one histo-rate">
                                <span class="histo-star">
                                    <?php 
                                    $value = 0;
                                    $total = 0;
                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                    ?> 
                                    @if(!empty($reviews[0]))
                                        <?php
                                        $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                        foreach($reviews as $review){
                                            $value = $review->value*5;
                                            $total = $total + $value;
                                        }

                                        $count = ($count*1) * 5;
                                        $rat = $total/$count;
                                        $ratings_var = ($rat*100)/5;
                                        ?>
                        
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                     
                                    @else
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                                <span class="histo-percent">
                                    <a href="#" title="rate">{{ round($ratings_var) }}%</a>
                                </span>
                                <span class="bar-block">
                                    <span id="bar-one" style="width: {{ $ratings_var }}%" class="bar bar-clr bar-radius">&nbsp;</span> 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endif
                @auth
                <div class="udemy-review btm-40">
                     @php
                        $orders = App\Order::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                    @endphp
                    @if(!empty($orders))
                        <div class="review-block">
                            <div class="row">
                                <div class="col-lg-2">
                                    <h3 class="top-20">Reviews</h3>
                                </div>
                                <div class="col-lg-10 col-12">
                                    <form id="demo-form2" method="post" action="{{route('course.rating',$course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}
                                        <div class="review-table top-20">
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                  <th scope="col"></th>
                                                  <th scope="col">1 Star</th>
                                                  <th scope="col">2 Star</th>
                                                  <th scope="col">3 Star</th>
                                                  <th scope="col">4 Star</th>
                                                  <th scope="col">5 Star</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <th scope="row">Learn</th>
                                                  <td><input type="radio" name="learn" value="1" id="option1" autocomplete="off"></td>
                                                  <td><input type="radio" name="learn" value="2" id="option2" autocomplete="off"></td>
                                                  <td><input type="radio" name="learn" value="3" id="option3" autocomplete="off"></td>
                                                  <td><input type="radio" name="learn" value="4" id="option4" autocomplete="off"></td>
                                                  <td><input type="radio" name="learn" value="5" id="option5" autocomplete="off"></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Price</th>
                                                  <td><input type="radio" name="price" value="1" id="option6" autocomplete="off"></td>
                                                  <td><input type="radio" name="price" value="2" id="option7" autocomplete="off"></td>
                                                  <td><input type="radio" name="price" value="3" id="option8" autocomplete="off"></td>
                                                  <td><input type="radio" name="price" value="4" id="option9" autocomplete="off"></td>
                                                  <td><input type="radio" name="price" value="5" id="option10" autocomplete="off"></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Value</th>
                                                  <td><input type="radio" name="value" value="1" id="option11" autocomplete="off"></td>
                                                  <td><input type="radio" name="value" value="2" id="option12" autocomplete="off"></td>
                                                  <td><input type="radio" name="value" value="3" id="option13" autocomplete="off"></td>
                                                  <td><input type="radio" name="value" value="4" id="option14" autocomplete="off"></td>
                                                  <td><input type="radio" name="value" value="5" id="option15" autocomplete="off"></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            <div class="review-text btm-30">
                                                <label for="review">Write a review:</label>
                                                <textarea name="review" rows="4" class="form-control" placeholder=""></textarea>
                                            </div>
                                            <div class="review-rating-btn text-right">
                                                <button type="submit" class="btn btn-success" title="Review">Review</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr>

                    @endif


                    @php
                        $alreadyrated = App\ReviewRating::where('course_id', $course->id)->first();
                    @endphp
                    @if($alreadyrated == !NULL)

                    <div class="review-dtl">
                        <?php

                            $user_count = count([$alreadyrated]);
                            $user_sub_total = 0;
                            $user_learn_t = $alreadyrated->learn * 5;
                            $user_price_t = $alreadyrated->price * 5;
                            $user_value_t = $alreadyrated->value * 5;
                            $user_sub_total = $user_sub_total + $user_learn_t + $user_price_t + $user_value_t;

                            $user_count = ($user_count * 3) * 5;
                            $rat1 = $user_sub_total / $user_count;
                            $ratings_var1 = ($rat1 * 100) / 5;

                        ?>
                        @if(isset($alreadyrated))
                        @foreach($course->review as $rating)
                        @if($rating->review == !null && $rating->status == 1 && $rating->approved == 1)
                        <div class="row btm-20">
                            <div class="col-lg-4">
                                <div class="review-img text-white">
                                 {{ $rating->user->fname[0] }}{{ $rating->user->lname[0]  }}</div>
                                <div class="review-img-block">
                                    <div class="review-month">{{ date('d-m-Y', strtotime($rating->created_at)) }}</div>
                                    <div class="review-name">{{ $rating->user->fname }}</div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="review-rating">
                                    <div class="pull-left-review">
                                        <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var1; ?>%" class="star-ratings-sprite-rating"></span>
                                        </div>
                                    </div>
                                    <div class="review-text">
                                        <p>{{ $rating->review }}<p>
                                    </div>
                                    
                                    <div class="review">Was this review helpful?
                                        @php
                                        $help = App\ReviewHelpful::where('user_id', Auth::User()->id)->where('review_id', $rating->id)->first();
                                        @endphp
                                      
                                        @if($help == !NULL)
                                            <div class="helpful">
                                                <form  method="post" action="{{route('helpful.delete', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-link lft-7 rgt-10 yes-submitted"><i class="fa fa-check"></i> Yes</button>
                                                </form>
                                            </div>
                                            
                                        @else
                                            <div class="helpful">
                                                <form  method="post" action="{{route('helpful', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                                <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                                <input type="hidden" name="helpful"  value="yes" />
                                                
                                                  <button type="submit" class="btn btn-link lft-7 rgt-10">Yes</button>
                                                </form>
                                            </div>
                                        @endif
                                        {{-- report --}}
                                        <a href="#" data-toggle="modal" data-target="#myModalreport"  title="report">Report</a>
                                        <div class="modal fade" id="myModalreport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog modal-lg" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title" id="myModalLabel">Report</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="box box-primary">
                                                  <div class="panel panel-sum">
                                                    <div class="modal-body">
                                                        @php
                                                            $courses = App\Course::first();
                                                        @endphp
                                                        <form id="demo-form2" method="post" action="{{ route('report.review', $course->id) }}"              data-parsley-validate class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="review_id"  value="{{ $rating->id }}" />
                                                                    
                                                            <div class="row">
                                                              <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="title">Title:<sup class="redstar">*</sup></label>
                                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Please Enter Title" value="">
                                                                </div>
                                                              </div>
                                                              <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">Email:<sup class="redstar">*</sup></label>
                                                                    <input type="email" class="form-control" name="email" id="title" placeholder="Please Enter Email" value="{{ Auth::User()->email }}" required>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="row">
                                                              <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="detail">Detail:<sup class="redstar">*</sup></label>
                                                                    <textarea name="detail" rows="4"  class="form-control" placeholder=""></textarea>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <br>
                                                            <div class="box-footer">
                                                             <button type="submit" class="btn btn-lg col-md-3 btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    @endif
                    
                </div>
                @endauth
                
                @if(!$relatedcourse->isEmpty())
                <div class="more-courses btm-30">
                    <h2 class="more-courses-heading">Related Courses</h2>
                    <div class="row">
                        @foreach($relatedcourse as $rel)
                        @if($rel->status ==1)
                        <div class="col-lg-4 col-sm-6">
                            <div class="together-img">
                                <div class="student-view-block">
                                    <div class="view-block">
                                        <div class="view-img">
                                            <a href="{{ route('user.course.show',$rel->course_id) }}"><img src="{{ asset('images/course/'.$rel->courses->preview_image) }}" alt="student">
                                            </a>
                                        </div>
                                        {{-- Add to wishlisht --}}
                                        @if (Auth::check())
                                        @php
                                            $wishtt = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $rel->course_id)->first();
                                        @endphp
                                        @if ($wishtt == NULL)
                                            <div class="heart">
                                                <form id="demo-form2" method="post" action="{{ url('show/wishlist', $rel->course_id) }}" data-parsley-validate 
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$rel->course_id}}" />

                                                    <button class="wishlisht-btn heart" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="heart-two">
                                                <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $rel->course_id) }}" data-parsley-validate 
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$rel->course_id}}" />

                                                    <button class="wishlisht-btn heart"  title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @endif
                                        @else
                                            <div class="heart">
                                                <a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a>
                                            </div>
                                        @endif
                                        {{-- Add to wishlisht end--}}

                                        <div class="view-dtl">
                                            <div class="view-heading btm-10"><a href="{{ route('user.course.show',$rel->course_id) }}">{{ $rel->courses->title }}</a></div>
                                            <p class="btm-10"><a herf="#">by {{ $rel->user->fname }}</a></p>
                                            <div class="rating">
                                                <ul>
                                                    <li>
                                                    <?php 
                                                    $learn = 0;
                                                    $price = 0;
                                                    $value = 0;
                                                    $sub_total = 0;
                                                    $sub_total = 0;
                                                    $reviews = App\ReviewRating::where('course_id',$rel->course_id)->where('status','1')->get();
                                                    ?> 
                                                    @if(!empty($reviews[0]))
                                                    <?php
                                                    $count =  App\ReviewRating::where('course_id',$rel->course_id)->count();

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
                                                        <div class="pull-left no-rating">
                                                            No Rating
                                                        </div>
                                                    @endif 
                                                    </li>

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
                                                        $reviewsrating = App\ReviewRating::where('course_id', $rel->course_id)->first();
                                                    @endphp
                                                    @if(!empty($reviewsrating))
                                                    <li>
                                                        <b>({{ round($overallrating, 1) }})</b>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            @if( $rel->courses->type == 1)
                                                @php
                                                    $currency2 = App\Currency::first();
                                                @endphp
                                                @if($rel->courses->discount_price == !NULL)
                                                    <div class="rate text-right">
                                                        <ul>
                                                            <li><a><b><i class="{{ $currency2->icon }}"></i>{{ $rel->courses->discount_price }}</b></a></li>&nbsp;
                                                            <li><a><b><strike><i class="{{ $currency2->icon }}"></i>{{ $rel->courses->price }}</strike></b></a></li>
                                                        </ul>
                                                    </div>
                                                @else
                                                    <div class="rate text-right">
                                                        <ul>
                                                            <li><a><b><i class="{{ $currency2->icon }}"></i>{{ $rel->courses->price }}</b></a></li>
                                                        </ul>
                                                    </div>
                                                @endif
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
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
                @if(Auth::check())
                    <div class="report-abuse text-center btm-20">
                        <a href="#" data-toggle="modal" data-target="#myModalCourse" title="report"><i class="fa fa-flag rgt-10"></i>Report abuse</a>
                    </div>
                @else
                    <div class="report-abuse text-center btm-20">
                        <a href="{{ route('login') }}" title="report"><i class="fa fa-flag rgt-10"></i>Report abuse</a>
                    </div>
                @endif

                <!--Model start-->
                @auth
                <div class="modal fade" id="myModalCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">

                          <h4 class="modal-title" id="myModalLabel">Report Course</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="box box-primary">
                          <div class="panel panel-sum">
                            <div class="modal-body">
                            
                            <form id="demo-form2" method="post" action="{{ route('course.report', $course->id) }}"
                                data-parsley-validate class="form-horizontal form-label-left">
                                    {{ csrf_field() }}
                                        
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title:<sup class="redstar">*</sup></label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Please Enter Title" value="" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email:<sup class="redstar">*</sup></label>
                                        <input type="email" class="form-control" name="email" id="title" placeholder="Please Enter Email" value="{{ Auth::user()->email }}" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="detail">Detail:<sup class="redstar">*</sup></label>
                                        <textarea name="detail" rows="4"  class="form-control" placeholder="Enter Detail" required></textarea>
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-lg col-md-3 btn-primary">Submit</button>
                                </div>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 
                </div>
                @endauth
                <!--Model close -->
            </div>
        </div>
    </div>
</section>
<!-- course detail end -->
@endsection
