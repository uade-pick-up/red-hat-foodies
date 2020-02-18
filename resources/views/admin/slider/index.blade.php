@extends('admin/layouts.master')
@section('title', 'View Slider - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Slider</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">

            <thead>
              <a class="btn btn-info btn-sm" href="{{url('slider/create')}}">
              <i class="glyphicon glyphicon-th-l">+Add</i></a>
              <br>
              <br>
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Heading</th>
                <th>Sub Heading</th>
                <th>Search Text</th>
                <th>Detail</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0;?>
              @foreach($sliders as $cat)
              <?php $i++;?>
              <tr>
                <td><?php echo $i;?></td>
                <td>
                  <img src="images/slider/<?php echo $cat['image'];  ?>" class="img-responsive">
                </td>
                <td>{{$cat->heading}}</td>
                <td>{{$cat->sub_heading}}</td>
                <td>{{$cat->search_text}}</td>
                <td>{{ strip_tags(str_limit($cat->detail, $limit = 50, $end = '...')) }}</td>   
                <td>
                   <form action="{{ route('slider.udemy',$cat->id) }}" method="POST">
                      {{ csrf_field() }}
                      <button  type="Submit" class="btn btn-xs {{ $cat->status ==1 ? 'btn-success' : 'btn-danger' }}">
                        @if($cat->status ==1)
                        Active
                        @else
                        Deactive
                        @endif
                      </button>
                    </form>
                </td>
              
                <th><a class="btn btn-primary btn-sm" href="{{url('slider/'.$cat->id)}}">
                  <i class="glyphicon glyphicon-pencil"></i></a></th>

                <td>
                  <form  method="post" action="{{url('slider/'.$cat->id)}}
                      "data-parsley-validate class="form-horizontal form-label-left">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                       <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                  </form>
                </td>

                @endforeach
             
              </tr>
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