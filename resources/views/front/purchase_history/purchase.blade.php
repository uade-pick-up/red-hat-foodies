@extends('theme.master')
@section('title', 'Purchase History')
@section('content')

@include('admin.message')



<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">Purchase History</h1>
    </div>
</section> 
<!-- about-home start -->

<!-- about-home end -->
<section id="purchase-block" class="purchase-main-block">
	<div class="container">
		<div class="purchase-table table-responsive">
	        <table class="table">
			  <thead>
			    <tr>
	                <th class="purchase-history-heading">Purchase history</th>
				    <th class="purchase-text">Date</th>
				    <th class="purchase-text">Payment Method</th>
				    <th class="purchase-text">Currency</th>
				    <th class="purchase-text">Total price</th>
				    <th class="purchase-text">Payment Status</th>
				    <th class="purchase-text">Actions</th>
			    </tr>
			  </thead>
				
				@foreach($orders as $order)
				@if($order->user_id == Auth::User()->id)
		            <div class="purchase-history-table">
		            	<tbody>
			            	<tr>
				    			<td >
				                    <div class="purchase-history-course-img">
				                        <a href="{{ route('user.course.show',$order->courses->id) }}"><img src="{{ asset('images/course/'. $order->courses->preview_image) }}" class="img-fluid" alt="blog"></a>
				                    </div>
				                    <div class="purchase-history-course-title">
				                        <a href="#">{{ $order->courses->title }}</a>
				                    </div>
				                </td>
				                <td>
				                   	<div class="purchase-text">{{ date('jS F Y', strtotime($order->created_at)) }}</div>			                   	
				                </td>

				                <td>   
				                    <div class="purchase-text">{{ $order->payment_method }}</div>
				                </td>

				                <td>
				                   	<div class="purchase-text">{{ $order->currency }}</div>
				                </td>
				                
				                <td>
				                	@if($order->coupon_discount == !NULL)
				                    	<div class="purchase-text"><b><i class="fa {{ $order->currency_icon }}"></i>{{ $order->total_amount - $order->coupon_discount }}</b></div>
				                    @else
				                    	<div class="purchase-text"><b><i class="fa {{ $order->currency_icon }}"></i>{{ $order->total_amount }}</b></div>
				                    @endif

				                </td>

				                <td>
				                	<div class="purchase-text">
				                		@if($order->status ==1)
				                            Recieved
				                        @else
				                            Pending
				                        @endif
				                	</div>
				                </td>
				               
				                <td>
				                    <div class="invoice-btn">
				                    	
				                    	<a href="{{route('invoice.show',$order->id)}}"  class="btn btn-secondary">Invoice</a>
				                    	
				                    </div>
				                </td>
				            </tr>
				        </tbody>
		            </div>
	            @endif
	            @endforeach
	        </table>
        </div>
	</div>
</section>

@endsection
