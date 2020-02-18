@extends('admin/layouts.master')
@section('title', 'View Trusted - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Trusted Slider</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <a class="btn btn-info btn-sm" href="{{url('trusted/create')}}">
                    <i class="glyphicon glyphicon-th-l">+Add</i></a>
                  <br>
                  <br>
                  <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Url</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=0;?>
                @foreach($trusted as $trusted)
                <?php $i++;?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td>
                    <img src="images/trusted/<?php echo $trusted['image'];  ?>">
                  </td>
                  <td>{{$trusted->url}}</td>
                  <td>
                    @if($trusted->status==1)
                      {{'Active'}}
                    @else
                      {{'Deactive'}}
                    @endif
                  </td>
                  <td>              
                    <a class="btn btn-sm btn-info" href="{{url('trusted/'.$trusted->id)}}">
                    <i class="fa fa-pencil"></i></a>
                  </td>
                  <td>

                    <form  method="post" action="{{url('trusted/'.$trusted->id)}}
                        "data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
                
                </tfoot>
              </table>
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