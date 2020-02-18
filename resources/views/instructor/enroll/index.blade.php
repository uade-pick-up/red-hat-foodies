@extends('admin/layouts.master')
@section('title', 'All Order - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">User Order</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                
                <br>
                <br>
                <tr>
                  <th>S.No</th>
                  <th>User</th>
                  <th>Course</th>
                  <th>Transaction Id</th>
                  <th>Payment Method</th>
                  <th>Currency</th>
                  <th>Total Amount</th>
                  <th>View</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
              <?php $i=0;?>
              @foreach($orders as $order)
                <?php $i++;?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td>{{$order->user->fname}}</td>                 
                  <td>{{$order->courses['title']}}</td>
                  <td>{{$order->transaction_id}}</td>
                  <td>{{$order->payment_method}}</td>
                  <td>{{$order->currency}}</td>

                  @if($order->coupon_discount == !NULL)
                    <td><i class="{{ $order->currency_icon }}"></i>{{ $order->total_amount - $order->coupon_discount }}</td>
                  @else
                    <td><i class="fa {{ $order->currency_icon }}"></i>{{ $order->total_amount }}</td>
                  @endif

                  <td><a class="btn btn-primary btn-sm" href="{{route('view.order',$order->id)}}">View</a>
                  </td>
                  
                  <td>
                    <form  method="post" action="{{url('order/'.$order->id)}}"
                        data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger">
                            <i class="fa fa-fw fa-trash-o"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach 
            </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection
