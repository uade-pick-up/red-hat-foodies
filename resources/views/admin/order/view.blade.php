@extends('admin.layouts.master')
@section('title', 'View Order - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
    <div class="row">
      <div class="col-md-12">
      	<div class="box box-primary">
           	<div class="box-header with-border">
            	<h3 class="box-title">Invoice</h3>
         		</div>
          	<div class="panel-body">
				
  					<div id="printableArea">
  						<!-- title row -->
  						<div class="row">
  						    <div class="col-xs-12">
  						      <h2 class="page-header">
  						        @if($setting->logo_type == 'L')
                        <div class="logo-invoice">
                          <img src="{{ asset('images/logo/'.$setting->logo) }}">
                        </div>
                      @else()
                          <a href="{{ url('/') }}"><b><div class="logotext" >{{ $setting->project_title }}</div></b></a>
                      @endif
  						        <small>Date:&nbsp;{{ date('jS F Y', strtotime($show->created_at)) }}</small>
  						      </h2>
  						    </div>
  						    <!-- /.col -->
  						</div>
  						<!-- info row -->
              <div class="view-order">
    						<div class="row invoice-info">
    						    <div class="col-sm-4 invoice-col">
    						      From:
    						      <address>
    						        <strong>{{ $show->courses->user->fname }}</strong><br>
    						        Address: {{ $show->courses->user->address }}<br>
                        @if($show->courses->user->state_id == !NULL)
                        {{ $show->courses->user->state->name }},
                        @endif
                        @if($show->courses->user->country_id == !NULL)
                          {{ $show->courses->user->country->name }}
                        @endif
                        <br>
    						        Phone:&nbsp;{{ $show->courses->user->mobile }}<br>
    						        Email:&nbsp;{{ $show->courses->user->email }}
    						      </address>
    						    </div>
    						    <!-- /.col -->
    						    <div class="col-sm-4 invoice-col">
    						      To:
    						      <address>
    						        <strong>{{ $show->user->fname }}</strong><br>
                        Address: {{ $show->user->address }}<br>
                        @if($show->user->state_id == !NULL)
                          {{ $show->user->state->name }},
                        @endif
                        @if($show->user->country_id == !NULL)
                          {{ $show->user->country->name }}<br>
                        @endif
    						        Phone:&nbsp;{{ $show->user->mobile }}<br>
    						        Email:&nbsp;{{ $show->user->email }}
    						      </address>
    						    </div>
    						    <!-- /.col -->
    						    <div class="col-sm-4 invoice-col">
    						      {{-- <b>Invoice #007612</b><br> --}}
    						      <br>
    						      <b>Transaction ID:</b>&nbsp;{{ $show->transaction_id }}<br>
    						      <b>Payment Mode:</b>&nbsp;{{ $show->payment_method }}<br>
    						      <b>Currency:</b>&nbsp;{{ $show->currency }}
    						    </div>
    						    <!-- /.col -->
    						</div>
              </div>
  						<!-- /.row -->
  		          		
          		<div class="order-table">
          			<table class="table table-striped">
  							  <thead>
  							    <tr>
  							      <th>Course name</th>
  							      <th>Instructor</th>
                      <th>Currency</th>
                      @if($show->coupon_discount != 0)
                      <th>Coupon Discount</th>
                      @endif
  							      <th>Total</th>
  							    </tr>
  							  </thead>
  							  <tbody>
  							    <tr>
  							      <td>{{ $show->courses->title }}</td>
  							      <td>{{ $show->courses->user->email }}</td>
                      <td>{{ $show->currency }}</td>

                      @if($show->coupon_discount != 0)
                      <td>
                        (-)&nbsp;<i class="{{ $show->currency_icon }}"></i>{{ $show->coupon_discount }}
                      </td>
                      @endif

  							      <td>
                        @if($show->coupon_discount == !NULL)
                          <i class="fa {{ $show->currency_icon }}"></i>{{ $show->total_amount - $show->coupon_discount }}
                        @else
                          <i class="fa {{ $show->currency_icon }}"></i>{{ $show->total_amount }}
                        @endif
                      </td>
  							    </tr>
  							  </tbody>
  							</table>
          		</div>

            </div>
  					
  					<input type="button" class="btn btn-primary"  onclick="printDiv('printableArea')" value="Print Invoice" />

          	</div>
      	</div>
    	</div>
    </div>
</section>

@endsection


@section('scripts')

<script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
  	});
</script>

<script lang='javascript'>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
	}
</script>
@endsection


