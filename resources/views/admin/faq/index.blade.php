@extends('admin/layouts.master')
@section('title', 'All Faq - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">FAQ Student</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <a href="{{url('faq/create')}}" class="btn btn-info btn-sm">+ Add</a> 
              <br>
              <br>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Details</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
            @foreach($faq as $key=>$p)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$p->title}}</td>                 
                <td>{{ str_limit(strip_tags($p->details), $limit = 50, $end = '...')}}</td>
                <td>
                  <form action="{{ route('faq.quick',$p->id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="Submit" class="btn btn-xs {{ $p->status ==1 ? 'btn-success' : 'btn-danger' }}">
                      @if($p->status ==1)
                      Active
                      @else
                      Deactive
                      @endif
                    </button>
                  </form>
                </td>
                <td><a class="btn btn-success btn-sm" href="{{url('faq/'.$p->id.'/edit')}}">
                    <i class="glyphicon glyphicon-pencil"></i></a>
                </td>
                <td>
                  <form  method="post" action="{{url('faq/'.$p->id)}}"
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
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection
