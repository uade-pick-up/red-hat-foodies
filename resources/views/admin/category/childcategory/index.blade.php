@extends('admin/layouts.master')
@section('title', 'View Childcategory - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Child Category</h3>
        </div>
        <div class="box-header">
          <a href="{{url('childcategory/create')}}" class="btn btn-info btn-sm">+ Add Child Category</a> 
          <br>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                
                <tr>
                  
                  <th>S.No</th>
                  <th>SubCategory</th>
                  <th>Child Category</th>
                  <th>Icon</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0;?>
                @foreach($childcategory as $cat)
                <?php $i++;?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td>{{$cat->subcategory->title}}</td>
                  <td>{{$cat->title}}</td>
                  <td><i class="fa {{$cat->icon}}"></i></td>
                  <td>
                    <form action="{{ route('childcategory.quick',$cat->id) }}" method="POST">
                      {{ csrf_field() }}
                      <button type="Submit" class="btn btn-xs {{ $cat->status ==1 ? 'btn-success' : 'btn-danger' }}">
                        @if($cat->status ==1)
                        Active
                        @else
                        Deactive
                        @endif
                      </button>
                    </form>
                  </td>
                  <td>
                    <a class="btn btn-success btn-sm" href="{{url('childcategory/'.$cat->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
                  </td>
                  <td>
                    <form  method="post" action="{{url('childcategory/'.$cat->id)}}"data-parsley-validate class="form-horizontal form-label-left">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
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
