@extends('admin/layouts.master')
@section('title', 'Instructor Request - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Instructor Request</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              
              <thead>
                <br>
                <br>
                <tr>
                	<th>Image</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Detail</th>
                  <th>Status</th>
                  <th>View</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach($items as $item)
                <tr>
                  @if($item->status == 'pending')
                  	<td><img src="{{ asset('images/instructor/'.$item->image)}}"></td> 
                    <td>{{$item->fname}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{ str_limit($item->detail, $limit= 50, $end = '...')}}</td>
                    <td>
                      @if($item->status==1)
                        {{'Approved'}}
                      @else
                        {{'Pending'}}
                      @endif
                    </td>
                    <td><a class="btn btn-primary btn-sm" href="{{route('requestinstructor.edit',$item->id)}}">View</a></td>

                    <td><form  method="post" action="{{url('requestinstructor/'.$item->id)}}
                          "data-parsley-validate class="form-horizontal form-label-left">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                           <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                        </form>
                    </td>
                  @endif

                  @endforeach
               
                </tr>
              </tfoot>
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