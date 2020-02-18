@extends('admin/layouts.master')
@section('title', 'All Order - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Course Answers</h3>
        </div>
        <div class="box-header">
           <a class="btn btn-info btn-sm" href="{{ url('instructoranswer/create') }}">+ Add New Answer</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">

        <thead>
          <br>
          <br>
          <th>S No.</th>
          <th>Answer</th>
          <th>Question</th>
          <th>Course</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0;?>
        @foreach($answers as $ans)
        <tr>
          <?php $i++;?>
          <td><?php echo $i;?></td>
            <td>{{$ans->answer}}</td>
            <td>{{$ans->question->question}}</td>
            <td>{{$ans->courses->title}}</td> 
          <td>
              @if($ans->status==1)
                {{'Active'}}
              @else
                {{'Deactive'}}
              @endif                      
          </td>
          
          <td>
            <a class="btn btn-primary btn-sm" href="{{url('instructoranswer/'.$ans->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
          </td>

          <td><form  method="post" action="{{url('instructoranswer/'.$ans->id)}}
              "data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
        
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
