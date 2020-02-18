@extends('admin/layouts.master')
@section('title', 'View Category - Admin')
@section('body')
 
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Categories</h3>
        </div>
        <div class="box-header">
          <button type="button"class="btn btn-info btn-sm"  data-toggle="modal" data-target="#myModal">
            + Add Category
          </button>
          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Add Category</h4>
                </div>
                <div class="modal-body">
                  <form id="demo-form2" method="post" action="{{url('category/')}}" data-parsley-validate class="form-horizontal form-label-left" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="row">
                      <div class="col-md-12">
                        <label for="c_name">Category Name:<sup class="redstar">*</sup></label>
                        <input placeholder="Enter your category" type="text" class="form-control" name="title" required="">
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <label for="icon">Category Icon:<sup class="redstar">*</sup></label>
                        <input type="text" class="form-control icp-auto icp" name="icon" required placeholder="Choose Icon">
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-4">
                        <label for="exampleInputDetails">Featured:</label>
                          <li class="tg-list-item">              
                          <input class="tgl tgl-skewed" id="featured" type="checkbox" name="featured" >
                          <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="featured"></label>
                        </li>
                        <input type="hidden"  name="free" value="0" for="featured" id="featured">
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputDetails">Status:</label>
                        <li class="tg-list-item">              
                          <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" >
                          <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                        </li>
                        <input type="hidden"  name="free" value="0" for="status" id="status">

                        
                      </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>S No.</th>
                  <th>Category</th>
                  <th>Icon</th>
                  <th>Slug</th>
                  <th>Featured</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0;?>
                @foreach($cate as $cate)
                <?php $i++;?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td>{{$cate->title}}</td>
                    <td><i class="fa {{$cate->icon}}"></i></td>
                    <td>{{$cate->slug}}</td>
                    <td>
                      <form action="{{ route('categoryf.quick',$cate->id) }}" method="POST">
                          {{ csrf_field() }}
                          <button type="Submit" class="btn btn-xs {{ $cate->featured ==1 ? 'btn-success' : 'btn-danger' }}">
                            @if($cate->featured ==1)
                           YES
                            @else
                            NO
                            @endif
                          </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('category.quick',$cate->id) }}" method="POST">
                          {{ csrf_field() }}
                          <button type="Submit" class="btn btn-xs {{ $cate->status ==1 ? 'btn-success' : 'btn-danger' }}">
                            @if($cate->status ==1)
                            Active
                            @else
                            Deactive
                            @endif
                          </button>
                        </form>
                    </td>
            
                    <td>
                      <a class="btn btn-success btn-sm" href="{{url('category/'.$cate->id)}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
                    <td>
                      <form  method="post" action="{{url('category/'.$cate->id)}}"data-parsley-validate class="form-horizontal form-label-left">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                        <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
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

