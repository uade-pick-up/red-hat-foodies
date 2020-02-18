@extends('admin.layouts.master')
@section('title', 'Dashboard - Admin')
@section('body')

@if(Auth::User()->role == "admin")

<section class="content-header">
  <h1>
    Dashboard
    <small>{{ $project_title }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<section class="content">
	<!-- Main row -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
              	@php
              		$user = App\User::all();
              		if(count($user)>0){

              			echo count($user);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>User</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('user.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
              	@php
              		$cat = App\Categories::all();
              		if(count($cat)>0){

              			echo count($cat);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>Categories</p>
            </div>
            <div class="icon">
            	<i class="fa fa-th-large"></i>
            </div>
            <a href="{{url('category')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
              	@php
              		$course = App\Course::all();
              		if(count($course)>0){

              			echo count($course);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>Course Available</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('course')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
              	@php
              		$page = App\Order::all();
              		if(count($page)>0){

              			echo count($page);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('order')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>
              	@php
              		$faq = App\FaqStudent::all();
              		if(count($faq)>0){

              			echo count($faq);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>Total Faq</p>
            </div>
            <div class="icon">
              <i class="fa fa-question"></i>
            </div>
            <a href="{{url('faq')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>@php
              		$review = App\Page::all();
              		if(count($review)>0){

              			echo count($review);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>Pages</p>
            </div>
            <div class="icon">
             <i class="fa fa-folder"></i>
            </div>
            <a href="{{ url('page') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                @php
              		$review = App\Instructor::all();
              		if(count($review)>0){

              			echo count($review);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>Instructors</p>
            </div>
            <div class="icon">
             <i class="fa fa-user"></i>
            </div>
            <a href="{{ url('requestinstructor') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>
                @php
              		$review = App\Testimonial::all();
              		if(count($review)>0){

              			echo count($review);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>Testimonial</p>
            </div>
            <div class="icon">
             <i class="fa fa-folder"></i>
            </div>
            <a href="{{url('testimonial')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

	<!-- Main row -->
	<div class="row">
		<!-- Left col -->
    <div class="col-md-4">
      <!-- USERS LIST -->
      <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Latest Users</h3>

            <div class="box-tools pull-right">
              <span class="label label-danger">
                @php
                    $user = App\User::all();
                    if(count($user)>0){

                      echo count($user);
                    }
                    else{

                      echo "0";
                    }
                  @endphp
                Users
            </span>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            @php
              $users = App\User::limit(8)->orderBy('id', 'DESC')->get();
            @endphp
            <ul class="users-list clearfix">
              @foreach($users as $user)
              <li>
                @if($user->user_img != null || $user->user_img !='')
                  <img src="{{ asset('/images/user_img/'.$user->user_img) }}" class="img-fluid" alt="User Image">
                @else
                  <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="User Image">
                @endif
                <a class="users-list-name" href="#">{{ $user->fname }} {{ $user->lname }}</a>
                <span class="users-list-date">{{ date('F Y', strtotime($user->created_at)) }}</span>
              </li>
              @endforeach
              
            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="{{route('user.index')}}" class="uppercase">View All Users</a>
          </div>
          <!-- /.box-footer -->
      </div>
      <!--/.box -->

        <!-- PRODUCT LIST -->
      @php
        $courses = App\Course::limit(5)->orderBy('id', 'DESC')->get()
      @endphp
      @if(!$courses->isEmpty())
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Recently Added Courses</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              
              @foreach($courses as $course)
              <li class="item">
                <div class="product-img">
                  <img src="images/course/<?php echo $course['preview_image'];  ?>" alt="Product Image">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">{{ str_limit($course->title, $limit = 25, $end = '...') }}
                  <span class="label label-warning pull-right">
                    @if( $course->type == 1)
                      @php
                          $currency2 = App\Currency::first();
                      @endphp
                      @if($course->discount_price == !NULL)
                        <i class="{{ $currency2->icon }}"></i>{{ $course->discount_price }}
                      @else
                        <i class="{{ $currency2->icon }}"></i>{{ $course->price }}
                      @endif
                    @else
                      Free
                    @endif
                </span></a>
                 
                  <span class="product-description">
                      {{ str_limit($course->short_detail, $limit = 40, $end = '...') }}
                  </span>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="{{url('course')}}" class="uppercase">View All Courses</a>
          </div>
          <!-- /.box-footer -->
      </div>
      @endif
      <!-- /.box -->
    </div>
    <!-- /.col -->
		<div class="col-md-8">
		  <!-- TABLE: LATEST ORDERS -->
      @php
        $orders = App\Order::limit(7)->orderBy('id', 'DESC')->get();
      @endphp
      @if( !$orders->isEmpty() )
			<div class="box box-info">
			    <div class="box-header with-border">
			      <h3 class="box-title">Latest Orders</h3>

			      <div class="box-tools pull-right">
			        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			        </button>
			        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			      </div>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			      <div class="table-responsive">
			        <table class="table no-margin">
			          <thead>
			          <tr>
			            <th>User</th>
			            <th>Course</th>
			            <th>Amount</th>
			            <th>Transaction Date</th>
                  <th>Invoice</th>
			          </tr>
			          </thead>
			          <tbody>
                  @php
                    $orders = App\Order::limit(7)->orderBy('id', 'DESC')->get();
                  @endphp
                  @foreach($orders as $order)
    			          <tr>
    			            <td><a href="#">{{ $order->user->fname }}</a></td>
    			            <td>{{ $order->courses->title }}</td>
    			            <td>
                        @if($order->coupon_discount == !NULL)
                          <span class="label label-success"><i class="fa {{ $order->currency_icon }}"></i> {{ $order->total_amount - $order->coupon_discount }}</span>
                        @else
                          <span class="label label-success"><i class="fa {{ $order->currency_icon }}"></i> {{ $order->total_amount }}</span>
                        @endif
                      </td>
    			            <td>
    			              <div class="sparkbar" data-color="#00a65a" data-height="20">{{ date('jS F Y', strtotime($order->created_at)) }}</div>
    			            </td>
                      <td><a href="{{route('view.order',$order->id)}}">Invoice</a></td>
    			          </tr>
                  @endforeach
			          </tbody>
			        </table>
			      </div>
			      <!-- /.table-responsive -->
			    </div>
			    <!-- /.box-body -->
			    <div class="box-footer clearfix">
			      <a href="{{url('order')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
			    </div>
			    <!-- /.box-footer -->
			</div>
      @endif

			<!-- /.box -->

      <!-- Instructor box -->
      @php
        $instructors = App\Instructor::limit(3)->orderBy('id', 'DESC')->get();
      @endphp
      @if( !$instructors->isEmpty() )
      <div class="box box-success">
        <div class="box-header">
          <i class="fa fa-user-plus"></i>

          <h3 class="box-title">New Instructor Request</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chat" id="chat-box">
          <!-- chat item -->
          
          @foreach($instructors as $instructor)
          @if($instructor->status == 0)
            <div class="item">
              <img src="{{ asset('images/instructor/'.$instructor->image)}}" alt="user image" class="online">

              <p class="message">
                <a href="#" class="name">
                  <small class="text-muted pull-right"><i class="fa fa-calendar-check-o"></i>&nbsp;{{ date('jS F Y', strtotime($instructor->created_at)) }}</small>
                  {{ $instructor->fname }}&nbsp;{{ $instructor->lname }}
                </a>
                {{ str_limit($instructor->detail, $limit = 160, $end = '...') }}
              </p>
              <div class="attachment">
                <h4>Resume:</h4>
                <p class="filename">
                  <a href="{{ asset('files/instructor/'.$instructor->file) }}" download="{{$instructor->file}}">Download <i class="fa fa-download"></i></a>
                </p>

                <div class="pull-right">
                  <button type="button" onclick="window.location.href = '{{route('requestinstructor.edit',$instructor->id)}}';" class="btn btn-primary btn-sm btn-flat">View Details</button>
                </div>
              </div>
              <!-- /.attachment -->
            </div>
          @endif
          @endforeach
          <!-- /.item -->
        </div>
        <!-- /.chat -->
        <div class="box-footer text-center">
          <a href="{{route('all.instructor')}}" class="btn btn-sm bg-navy btn-flat pull-left">All Instructors</a>
          <a href="{{url('requestinstructor')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Instructor Request</a>
        </div>
      </div>
      @endif
      <!-- /.box (Instructor box) -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>

@endif

@endsection