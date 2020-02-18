@extends('admin.layouts.master')
@section('title', 'View User - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Users</h3>
        </div>
        <div class="box-header">

          <a class="btn btn-info btn-sm" href="{{ route('user.add') }}">+ Add New User</a>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                  <th>SN</th>
                  <th>User Image</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Mobile No.</th>
                  <th>Country</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </thead> 

                <tbody>
                  <?php $i=0;?>

                    @foreach ($users as $user)
                      @if($user->id != Auth::User()->id)
                        <?php $i++;?>

                      <tr>
                        <td><?php echo $i;?></td>
                        <td>
                          @if($user->user_img != null || $user->user_img !='')
                            <img src="{{ url('/images/user_img/'.$user->user_img) }}" class="img-responsive">
                          @else
                            <img src="{{ asset('images/default/user.jpg')}}" class="img-responsive" alt="User Image">
                          @endif
                        </td>
                        <td>{{ $user->fname }}</td>
                        <td>{{ $user->lname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          {{$user->mobile}}
                        </td>
                        <td>{{  $user->country['nicename']  }}</td>
                        <td>
                          <form action="{{ route('user.udemy',$user->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button  type="Submit" class="btn btn-xs {{ $user->status ==1 ? 'btn-success' : 'btn-danger' }}">
                              @if($user->status ==1)
                              Active
                              @else
                              Deactive
                              @endif
                            </button>
                          </form>
                        </td>
                        
                        <td>
                          <a class="btn btn-success btn-sm" href="{{ route('user.update',$user->id) }}">
                            <i class="glyphicon glyphicon-pencil"></i></a>
                        </td>
                              
                        <td><form  method="post" action="{{ route('user.delete',$user->id) }}
                            "data-parsley-validate class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                             <button  type="submit" class="btn btn-danger" onclick="return confirm('Delete This User..?)" ><i class="fa fa-fw fa-trash-o"></i></button></td>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach

                </tbody>
              </table>
            </div>
          </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection
