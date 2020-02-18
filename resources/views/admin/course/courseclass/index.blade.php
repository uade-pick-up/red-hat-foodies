<section class="content">
 
  <div class="row">
    <div class="col-md-12">
      <a data-toggle="modal" data-target="#myModalab" href="#" class="btn btn-info btn-sm">+Add</a>
      <br>
      <br>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Course Chapter</th>
            <th>Title</th>
            <th>Status</th>
            <th>Featured</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach($courseclass as $cat)
            <tr>
              @php
              $chname = App\CourseChapter::where('id','=',$cat->coursechapter_id)->get();
              @endphp
              <td>
                @foreach($chname as $cc)
                {{ $cc->chapter_name }}
                @endforeach
              </td>
              <td>{{$cat->title}}</td>
              <td>
                @if($cat->status==1)
                  {{'Active'}}
                @else
                  {{'Deactive'}}
                @endif
              </td>
              <td>
                @if($cat->featured==1)
                  {{'Yes'}}
                @else
                  {{'No'}}
                @endif
              </td>
              <td>
                <a class="btn btn-success btn-sm" href="{{url('courseclass/'.$cat->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
              </td> 
              <td>
                <form  method="post" action="{{url('courseclass/'.$cat->id)}}"data-parsley-validate class="form-horizontal form-label-left">
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
  <div class="modal fade" id="myModalab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add New Course Class</h4>
        </div>
        <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              <form enctype="multipart/form-data" id="demo-form2" method="post" action="{{ route('courseclass.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                          

                <select class="display-none" name="course_id" class="form-control">
                  <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                </select>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">Chapter Name</label>
                    <select name="course_chapters" class="form-control col-md-7 col-xs-12">
                      @foreach($coursechapters as $c)
                      <option value="{{ $c->id }}">{{ $c->chapter_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">Title:<sup class="redstar">*</sup></label>
                    <input type="text" class="form-control " name="title" id="exampleInputTitle"   placeholder="Enter Your Title"value="" required>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-12">
                    <label for="type">Type:</label>
                    <select name="type" id="filetype" class="form-control">
                      <option >Choose File Type</option>
                      <option value="video">Video</option>
                      <option value="image">Image</option>
                      <option value="zip">Zip</option>
                      <option value="pdf">Pdf</option>
                    </select>
                  </div>
                  <br>

                  <!--for image -->
                  <div class="col-md-12" id="imageChoose">
                    <input type="radio" name="checkImage" id="ch3" value="url"> URL
                    <input type="radio" name="checkImage" id="ch4" value="uploadimage"> Upload Image
                  </div>
                  
                  <div class="col-md-12 display-none" id="imageURL">
                    <label for="">Enter URL: </label>
                    <input type="text" name="imgurl" placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="imageUpload">
                    <label for="">Upload Image: </label>
                    <input type="file" name="image" class="form-control">
                  </div>



                  <!--video-->
                  <div class="col-md-12 display-none" id="videotype">
                    <input type="radio" name="checkVideo" id="ch1" value="url"> URL
                    <input type="radio" name="checkVideo" id="ch2" value="uploadvideo"> Upload Video
                    <input type="radio" name="checkVideo" id="ch9" value="iframeurl"> Iframe URL
                  </div>

                  <div class="col-md-12 display-none" id="videoURL">
                    <label for="">Enter URL: </label>
                    <input type="text" name="vidurl"  placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="videoUpload">
                    <label for="">Upload Video: </label>
                    <input type="file" name="video_upld" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="iframeURLBox">
                    <label for="">Enter Iframe URL: </label>
                    <input type="text" name="iframe_url"  placeholder="Enter Your Iframe URL" class="form-control">
                  </div>



                  <!-- zip -->
                  <div class="col-md-12 display-none" id="zipChoose">
                    <input type="radio" value="zipURLEnable" name="checkZip" id="ch5"> URL
                    <input type="radio" value="zipEnable" name="checkZip" id="ch6"> Upload Zip
                  </div>
                  
                  <div class="col-md-12 display-none" id="zipURL">
                    <label for="">Enter URL: </label>
                    <input type="text" name="zipurl" placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="zipUpload">
                    <label for="">Upload Zip: </label>
                    <input type="file" name="uplzip" class="form-control">
                  </div>


                  <!-- pdf -->
                  <div class="col-md-12 display-none" id="pdfChoose">
                    <input type="radio" value="pdfURLEnable" name="checkUrl" id="ch7"> URL
                    <input type="radio" value="pdfEnable" name="checkPdf" id="ch8"> Upload Pdf
                  </div>
                  
                  <div class="col-md-12 display-none" id="pdfURL">
                    <label for="">Enter URL: </label>
                    <input type="text" name="pdfurl" placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="pdfUpload">
                    <label for="">Upload Pdf: </label>
                    <input type="file" name="pdf" class="form-control">
                  </div>
                  <br>


                  <div class="col-md-12 display-none" id="duration">
                    <label for="">Duration :</label>
                    <input type="text" name="duration" placeholder="Enter class duration in (mins) Eg:160" class="form-control">
                  </div>
                  <br> 

                  <div class="col-md-12 display-none" id="size">
                    <label for="">Size:</label>
                    <input type="text" name="size" placeholder="Enter Your Size" class="form-control">
                  </div>
                </div>
                <br>

                <div class="row">  
                  <div class="col-md-4">    
                    <label for="exampleInputDetails">Status:</label>
                    <li class="tg-list-item">   
                      <input class="tgl tgl-skewed" id="c11"  type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="c11"></label>
                    </li>
                    <input type="hidden" name="status" value="1" id="t11">
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputDetails">Featured:</label>    
                    <li class="tg-list-item">
                      <input class="tgl tgl-skewed" id="cb100"   type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="NO" data-tg-on="YES" for="cb100"></label>
                    </li>
                    <input type="hidden" name="featured" value="1" id="c100">
                  </div>
                </div> 
                <br>
                <br>
               
                <div id="subtitle" class="display-none">
                  <label>Subtitle:</label>
                  <table class="table table-bordered" id="dynamic_field">  
                    <tr> 
                        <td>
                           <div class="{{ $errors->has('sub_t') ? ' has-error' : '' }} input-file-block">
                            <input type="file" name="sub_t[]"/>
                            <p class="info">Choose subtitle file ex. subtitle.srt, or. txt</p>
                            <small class="text-danger">{{ $errors->first('sub_t') }}</small>
                          </div>
                        </td>

                        <td>
                          <input type="text" name="sub_lang[]" placeholder="Subtitle Language" class="form-control name_list" />
                        </td>  
                        <td><button type="button" name="add" id="add" class="btn btn-xs btn-success">
                          <i class="fa fa-plus"></i>
                        </button></td>  
                    </tr>  
                  </table>
                </div>


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

</section> 

@section('scripts')
 <!--courseclass.js is included -->
@endsection
