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
  <div class="row">
    <div class="col-md-12">
      <a data-toggle="modal" data-target="#myModalabc" href="#" class="btn btn-info btn-sm">+Add</a>
      <br>
      <br>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Related Course</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach($relatedcourse as $cat)
            <tr>
              <td>{{$cat->courses->title}}</td>
              <td>
                  @if($cat->status==1)
                    {{'Active'}}
                  @else
                    {{'Deactive'}}
                  @endif
              </td>
              <td>
                <a class="btn btn-success btn-sm" href="{{url('relatedcourse/'.$cat->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
              </td>
              <td>
                <form  method="post" action="{{url('relatedcourse/'.$cat->id)}}
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

  <!--Model start-->
  <div class="modal fade" id="myModalabc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Related Course</h4>
        </div>
        <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              <form id="demo-form2" method="post" action="{{ route('relatedcourse.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}

                <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $cor->user_id }}"> 

                <div class="row">             
                  <div class="col-md-12">  
                    <label for="exampleInputSlug">Course</label>
                    <select name="main_course_id" class="form-control">
                      <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                    </select>
                  </div>
                </div> 
                      
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">Related Course:<sup class="redstar">*</sup></label>
                    @php
                    $courses = App\Course::all();
                    @endphp
                    <select name="course_id" class="form-control">
                      @foreach($courses as $course)
                        @if($course->id !== $cor->id)
                          <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endif
                      @endforeach
                    </select>
                    <p class="txt-desc">Please Choose Related Course</p>
                  </div>
                </div>
                <br>
                
                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">Status:</label>
                    <li class="tg-list-item">
                      <input class="tgl tgl-skewed" id="c2"  type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="c2"></label>
                    </li>
                    <input type="hidden" name="status" value="1" id="t2">
                  </div>
                </div>
                <br>

                <div class="box-footer">
                  <button type="submit" class="btn btn-md col-md-3 btn-primary">Submit</button>
                </div>
                   
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Model close --> 
</section> 
