@include('admin.message')
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Course</h3>
      </div>
      <div class="box-header">
        <a class="btn btn-info btn-sm" href="{{url('course/create')}}">
          <i class="glyphicon glyphicon">+ AddCourse</i>
        </a>
      </div>
      <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">

              <thead>
                
                <tr>
                  <th>S.No</th>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Instructor</th>
                  <th>Slug</th>
                  <th>Featured</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>

              <tbody>
                <?php $i=0;?>
                  @if(Auth::User()->role == "admin")
                    @foreach($course as $cat)
                      <?php $i++;?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td>
                          <img src="images/course/<?php echo $cat['preview_image'];  ?>" class="img-responsive" >
                        </td>
                        <td>{{$cat->title}}</td>
                        <td>{{ $cat->user->fname }}</td>
                        <td>{{$cat->slug}}</td>
                        <td>
                          <form action="{{ route('course.udemy',$cat->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button  type="Submit" class="btn btn-xs {{ $cat->featured ==1 ? 'btn-success' : 'btn-danger' }}">
                              @if($cat->featured ==1)
                              YES
                              @else
                              NO
                              @endif
                            </button>
                          </form>
                        </td>
                         
                        <td>
                          <form action="{{ route('course.quick',$cat->id) }}" method="POST">
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

                        <td>
                          <a class="btn btn-primary btn-sm" href="{{ route('course.show',$cat->id) }}">
                          <i class="glyphicon glyphicon-pencil"></i></a>
                        </td>

                        <td>
                          <form  method="post" action="{{url('course/'.$cat->id)}}
                            "data-parsley-validate class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button onclick="return confirm('Are you sure you want to delete?')"  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  @else
                  
                    @php
                      $cors = App\Course::where('user_id', Auth::User()->id)->get();
                    @endphp
                    @foreach($cors as $cor)
                      <?php $i++;?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td>
                          <img src="images/course/<?php echo $cor['preview_image'];  ?>" class="img-responsive">
                        </td>
                        <td>{{$cor->title}}</td>
                        <td>{{ $cor->user->fname }}</td>
                        <td>{{$cor->slug}}</td>
                        <td>
                          <form action="{{ route('course.udemy',$cor->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button  type="Submit" class="btn btn-xs {{ $cor->featured ==1 ? 'btn-success' : 'btn-danger' }}">
                              @if($cor->featured ==1)
                              YES
                              @else
                              NO
                              @endif
                            </button>
                          </form>
                        </td>
                         
                        <td>
                          
                          @if($cor->status ==1)
                            Active
                          @else
                            Deactive
                          @endif
                            
                        </td>

                        <td>
                          <a class="btn btn-primary btn-sm" href="{{ route('course.show',$cor->id) }}">
                          <i class="glyphicon glyphicon-pencil"></i></a>
                        </td>

                        <td>
                          <form  method="post" action="{{url('course/'.$cor->id)}}
                            "data-parsley-validate class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button onclick="return confirm('Are you sure you want to delete?')"  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  @endif
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
