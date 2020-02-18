@extends('theme.master')
@section('title', 'Invoice')
@section('content')

@include('admin.message')


<!-- about-home start -->
<section id="wishlist-home" class="wishlist-home-main-block">
    <div class="container">
        <h1 class="wishlist-home-heading text-white">Invoice</h1>
    </div>
</section> 
<!-- about-home end -->
<section id="purchase-block" class="purchase-main-block">
	<div class="container">
		<div class="panel-body">
					
			<div id="printableArea">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <div class="page-header">
              @php
                  $setting = App\setting::first();
              @endphp
              <div class="invoice-logo">
                @if($setting->logo_type == 'L')
                    <img src="{{ asset('images/logo/'.$setting->logo) }}" class="img-fluid" alt="logo">
                @else()
                    <a href="{{ url('/') }}"><b><div class="logotext">{{ $setting->project_title }}</div></b></a>
                @endif
              </div>
              <br>
              <small class="purchase-date">Puchased On: {{ date('jS F Y', strtotime($orders->created_at)) }}</small>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="view-order">
          <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From:
                <address>
                  <strong>{{ $orders->courses->user->fname }}</strong><br>
                  
                 
                  Address: {{ $orders->courses->user->address }}<br>
                    @if($orders->courses->user->state_id == !NULL)
                      {{ $orders->courses->user->state->name }},
                    @endif
                    @if($orders->courses->user->state_id == !NULL)
                      {{ $orders->courses->user->country->name }}
                    @endif
                    <br>

                  Phone: {{ $orders->courses->user->mobile }}<br>
                  Email: {{ $orders->courses->user->email }}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To:
                <address>
                  <strong>{{ $orders->user->fname }}</strong><br>
                  Address: {{ $orders->user->address }}<br>
                    @if($orders->user->state_id == !NULL)
                      {{ $orders->user->state->name }},
                    @endif
                    @if($orders->user->country_id == !NULL)
                      {{ $orders->user->country->name }}
                    @endif
                    <br>
                  Phone: {{ $orders->user->mobile }}<br>
                  Email: {{ $orders->user->email }}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                
                <br>
                <b>Transaction ID:</b> {{ $orders->transaction_id }}<br>
                <b>Payment Mode:</b> {{ $orders->payment_method }}<br>
                <b>Currency:</b> {{ $orders->currency }}</br>
                <b>Payment Status:</b> 
                @if($orders->status ==1)
                  Recieved
                @else 
                  Pending
                @endif
              </div>
              <!-- /.col -->
          </div>
        </div>
        <!-- /.row -->
        <div class="order-table table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Course name</th>
                <th>Instructor</th>
                <th>Currency</th>
                @if($orders->coupon_discount != 0)
                <th class="text-center">Coupon Discount</th>
                @endif
                <th class="txt-rgt">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $orders->courses->title }}</td>
                <td>{{ $orders->courses->user->email }}</td>
                <td>{{ $orders->currency }}</td>

                @if($orders->coupon_discount != 0)
                <td class="text-center">
                  (-)&nbsp;<i class="{{ $orders->currency_icon }}"></i>{{ $orders->coupon_discount }}
                </td>
                @endif

                <td class="txt-rgt">
                  @if($orders->coupon_discount == !NULL)
                    <i class="fa {{ $orders->currency_icon }}"></i>{{ $orders->total_amount - $orders->coupon_discount }}
                  @else
                    <i class="fa {{ $orders->currency_icon }}"></i>{{ $orders->total_amount }}
                  @endif
                </td>
               
              </tr>
            </tbody>
          </table>
        </div>
      </div>
			<div class="print-btn">
			  <input type="button" class="btn btn-primary"  onclick="printDiv('printableArea')" value="Print Invoice" />
      </div>

    </div>
	</div>
</section>

@endsection

@section('custom-script')

<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
	 }
</script>
@endsection
