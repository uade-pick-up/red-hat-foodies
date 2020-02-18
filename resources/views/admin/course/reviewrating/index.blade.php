<section class="content">
  <div class="row">
    <div class="col-md-12">
      <br>
      <br>
      <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Course</th>
              <th>User</th>
              <th>Review</th>
              <th>learn</th>
              <th>price</th>
              <th>value</th>
              <th>Status</th>
              <th>Approved</th>
              <th>Featured</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cor->review as $jp)
              <tr>
                <td>{{$jp->courses->title}}</td>

                @php
                $chn = App\User::where('id','=',$cor->user_id)->get();
                @endphp
                <td>
                @foreach($chn as $ccc)
                {{ $ccc->fname }}
                @endforeach
                </td>

                <td>{{$jp->review}}</td>
                <td>{{$jp->learn}}</td>
                <td>{{$jp->price}}</td>
                <td>{{$jp->value}}</td> 

                <td>
                  <form action="{{ route('reviewstatus.quick',$jp->id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="Submit" class="btn btn-xs {{ $jp->status ==1 ? 'btn-success' : 'btn-danger' }}">
                      @if($jp->status ==1)
                      Active
                      @else
                      Deactive
                      @endif
                    </button>
                  </form>
                </td>
                <td>
                  <form action="{{ route('reviewapproved.quick',$jp->id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="Submit" class="btn btn-xs {{ $jp->approved ==1 ? 'btn-success' : 'btn-danger' }}">
                      @if($jp->approved ==1)
                      Active
                      @else
                      Deactive
                      @endif
                    </button>
                  </form>
                </td>
                <td>
                  <form action="{{ route('reviewfeatured.quick',$jp->id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="Submit" class="btn btn-xs {{ $jp->featured ==1 ? 'btn-success' : 'btn-danger' }}">
                      @if($jp->featured ==1)
                      Active
                      @else
                      Deactive
                      @endif
                    </button>
                  </form>
                </td>
      
                <td><a class="btn btn-success btn-sm" href="{{url('reviewrating/'.$jp->id)}}"><i class="glyphicon glyphicon-pencil"></i></a></td> 
          

                <td>
                  <form  method="post" action="{{url('reviewrating/'.$jp->id)}}"data-parsley-validate class="form-horizontal form-label-left">
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
</section> 
