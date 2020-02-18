@extends('admin/layouts.master')
@section('title', 'View Course Language - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Course Language</h3>
        </div>
        <div class="panel-body">
          <a data-toggle="modal" data-target="#myModaljjh" href="#" class="btn btn-info btn-sm">+ Add</a>
          <br>
          <br>
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Language</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                  <?php $i=0;?>
                  @foreach($language as $cat)
                    <?php $i++;?>
                    <tr>
                      <td><?php echo $i;?></td>
                      <td>{{$cat->name}}</td>
                      <td>
                        <form action="{{ route('language.quick',$cat->id) }}" method="POST">
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
                      <td><a class="btn btn-success btn-sm" href="{{url('courselang/'.$cat->id.'/edit')}}">
                          <i class="glyphicon glyphicon-pencil"></i></a></td>
                      <td><form  method="put" action="{{url('courselang/'.$cat->id)}}
                            "data-parsley-validate class="form-horizontal form-label-left">
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
        <!--Panel Body end-->
      </div>
      <!--Box Primary end-->

      <!--Model start-->
      <div class="modal fade" id="myModaljjh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Add New Language</h4>
            </div>
            <div class="box box-primary">
              <div class="panel panel-sum">
                <div class="modal-body">
                  <form id="demo-form2" method="post" action="{{ route('courselang.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                    {{ csrf_field() }}
                            
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputSlug">Name:<sup class="redstar">*</sup></label>
                        <input type="text" class="form-control" name="name" id="exampleInputPassword1" placeholder="Please Enter Your  Language Name" value="">
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputDetails">Status:</label>
                          <li class="tg-list-item">              
                          <input class="tgl tgl-skewed" id="welmail" type="checkbox" name="status" >
                          <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="welmail"></label>
                        </li>
                        <input type="hidden"  name="free" value="0" for="status" id="status">
                      </div>
                    </div>
                    <br>
                    <div class="box-footer">
                     <button type="submit" class="btn btn-lg col-md-3 btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
      <!--Model close -->
  </div>
</section> 

@endsection
