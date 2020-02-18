@extends('admin/layouts.master')
@section('title', 'Edit Class - Admin')
@section('body')

<section class="content">
  
  <div class="row">
    <div class="col-md-7">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Course Class</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <form enctype="multipart/form-data" id="demo-form" method="post" action="{{url('courseclass/'.$cate->id)}}"data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
                        
              <select class="display-none" name="coursechapter" class="form-control col-md-7 col-xs-12">
                @php
                 $coursechapters = App\CourseChapter::all();
                @endphp  
                @foreach($coursechapters as $cat)
                    <option {{ $cate->coursechapter_id == $cat->id ? 'selected' : "" }} value="{{ $cat->id }}">{{ $cat->chapter_name }}</option>
                @endforeach
              </select>


              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputDetails">Title:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control " name="title" id="exampleInputTitle"  value="{{$cate->title}}">                  
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-12">
                  <label for="type">Course Chapter:</label>

                  <select name="coursechapter_id" id="chapters" class="form-control">
                    @foreach($coursechapt as $chapters)
                    <option value="{{ $chapters->id }}">{{ $chapters->chapter_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <br>
              
              <div class="row">
                <div class="col-md-12">
                  <label for="type">Type:</label>
                  <select name="type" id="filetype" class="form-control">
                    <option value="{{ $cate->type }}">{{ $cate->type }}</option>
                  </select>
                </div>
              </div>
              <br>
             
              @if($cate->type =="video")
                <div class="row">
                  <div class="col-md-12" id="videotype">
                    <input type="radio" name="checkVideo" id="ch1" value="url" {{ $cate->url !="" ? 'checked' : "" }}> URL
                    <input type="radio" name="checkVideo" id="ch2" value="uploadvideo" {{ $cate->video !="" ? 'checked' : "" }}> Upload Video
                    <input type="radio" name="checkVideo" id="ch9" value="iframeurl" {{ $cate->iframe_url !="" ? 'checked' : "" }}> Iframe URL
                    <br>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div id="videoURL" @if($cate->video !=NULL || $cate->iframe_url !=NULL) class="display-none" @endif >
                      <label for="">Enter URL: </label>
                      <input type="text" value="{{ $cate->url }}" name="vidurl" class="form-control">
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-12">
                    <div id="videoUpload" @if($cate->url !=NULL || $cate->iframe_url !=NULL) class="display-none" @endif >
                      <label for="">Upload Video: </label>
                      <input type="file" name="video_upld" class="form-control">
                      @if($cate->video !="")
                        <video src="{{ asset('video/class/'.$cate->video) }}" autoplay="no">
                        </video>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div id="iframeURLBox" @if($cate->url !=NULL || $cate->video !=NULL) class="display-none" @endif >
                      <label for="">Enter Iframe URL: </label>
                      <input type="text" value="{{ $cate->iframe_url }}" name="iframe_url" class="form-control">
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div  class="col-md-12" id="duration">
                    <label for="">Duration :</label>
                    <input type="text" name="duration" value="{{ $cate->duration }}" class="form-control" placeholder="Enter class duration in (mins) Eg:160">
                  </div>
                </div>
                <br>
              @endif

              @if($cate->type =="image")
               
                  <div class="col-md-7" id="imagetype">
                    <input type="radio" name="checkImage" id="ch3" value="url" {{ $cate->url !="" ? 'checked' : "" }}> URL
                    <input type="radio" name="checkImage" id="ch4"  {{ $cate->image !="" ? 'checked' : "" }} value="uploadimage"> Upload Image
                  </div>

                  <div class="col-md-7" id="imageURL" @if($cate->image !="") class="display-none" @endif >
                    <label for="">Enter URL: </label>
                    <input type="text" value="{{ $cate->url }}" name="imgurl" class="form-control">
                  </div>

                  <div class="col-md-7" id="imageUpload" @if($cate->url !="") class="display-none" @endif >
                    <label for="">Upload Image:</label>
                    <input type="file" name="image" class="form-control">
                    <br>
                    @if($cate->image !="")
                    <img src="{{ asset('images/class/'.$cate->image) }}" width="200" height="150" autoplay="no"> 
                    </img>

                    @endif
                  </div>
                  <br>
                  <br>
                   <div  class="col-md-7" id="size">
                    <label for="">Size :</label>
                    <input type="text" name="size" value="{{ $cate->size }}" class="form-control">
                  </div>
              @endif

              @if($cate->type =="zip")
                <div class="col-md-7" id="ziptype">
                  <input type="radio" name="checkZip" id="ch5" value="url" {{ $cate->url !="" ? 'checked' : "" }}> URL
                  <input type="radio" name="checkZip" id="ch6"  {{ $cate->zip !="" ? 'checked' : "" }} value="uploadzip"> Upload Zip
                </div>

                <div class="col-md-7" id="zipURL" @if($cate->zip !="") class="display-none" @endif >
                  <label for="">Enter URL: </label>
                  <input type="text" value="{{ $cate->url }}" name="zipurl" class="form-control">
                </div>

                <div class="col-md-7" id="zipUpload" @if($cate->url !="") class="display-none" @endif>
                  <label for="">Upload Zip File:</label>
                  <input type="file" name="zip" class="form-control">
                  <br>
                  @if($cate->zip !="")
                  <label for="">Zip File Name:</label>
                  <input value="{{ $cate->zip }}">
                  @endif
                </div>
                <br>
                <br>
                 <div  class="col-md-7" id="size">
                  <label for="">Size :</label>
                  <input type="text" name="size" value="{{ $cate->size }}" class="form-control">
                </div>
              @endif

              @if($cate->type =="pdf")
                <div class="col-md-7" id="pdftype">
                  <input type="radio" name="checkPdf" id="ch8" value="url" {{ $cate->url !="" ? 'checked' : "" }}> URL
                  <input type="radio" name="checkPdf" id="ch9"  {{ $cate->pdf !="" ? 'checked' : "" }} value="uploadpdf"> Upload Pdf
                </div>

                <div class="col-md-7" id="pdfURL" @if($cate->pdf !="") class="display-none" @endif >
                  <label for="">Enter URL: </label>
                  <input type="text" value="{{ $cate->url }}" name="pdfurl" class="form-control">
                </div>

                <div class="col-md-7" id="pdfUpload" @if($cate->url !="") class="display-none" @endif >
                  <label for="">Upload Pdf File:</label>
                  <input type="file" name="pdf" class="form-control">
                  <br>
                  @if($cate->pdf !="")
                  <label for="">Pdf File Name:</label>
                  <input value="{{ $cate->pdf }}">
                  @endif
                </div>
                <br>
                <br>
                 <div  class="col-md-7" id="size">
                  <label for="">Size :</label>
                  <input type="text" name="size" value="{{ $cate->size }}" class="form-control">
                </div>
              @endif
             
              <div class="row">
                <div class="col-md-4"> 
                  <label for="exampleInputTit1e">Status:</label>
                  <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $cate->status == '1' ? 'checked' : '' }} >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                </li>
                <input type="hidden"  name="free" value="0" for="status" id="status">
                  <br>
                </div>
                <div class="col-md-4"> 
                  <label for="exampleInputTit1e">Featured:</label>
                  <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="featured" type="checkbox" name="featured" {{ $cate->featured == '1' ? 'checked' : '' }} >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="featured"></label>
                </li>
                  <input type="hidden" name="free" value="0" id="featured">
                  <br>
                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-lg col-md-4 btn-primary">Save</button>
              </div>
            </form>
          </div>
      </div>
      </div>
    </div>


    @if($cate->type =="video")

    <div class="col-md-5">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Subtitle</h3>
        </div>
        <div class="box-body">
        <a data-toggle="modal" data-target="#myModalSubtitle" href="#" class="btn btn-info btn-sm">+ Add Subtitle</a>

          <!--Model start-->
        <div class="modal fade" id="myModalSubtitle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Subtitle</h4>
              </div>
              <div class="box box-primary">
              <div class="panel panel-sum">
                <div  class="modal-body">
                  <form enctype="multipart/form-data" id="demo-form2" method="post" action="{{ route('add.subtitle',$cate->id) }}" data-parsley-validate class="form-horizontal form-label-left">
                    {{ csrf_field() }}

                    <div id="subtitle">

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
      <table id="example1" class="table table-bordered table-striped">
          <thead>
            <br>
            <br>
            <tr>
              <th>#</th>
              <th>Subtitle Language</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=0;?>
            @foreach($subtitles as $subtitle)
              <?php $i++;?>
              <tr>
                <td><?php echo $i;?></td>
                <td>{{$subtitle->sub_lang}}</td>
                <td>
                  <form  method="post" action="{{ route('del.subtitle',$subtitle->id) }}"
                        data-parsley-validate class="form-horizontal form-label-left">
                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-danger display-inline">
                      <i class="fa fa-fw fa-trash-o"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach 
          </tbody> 
        </table>
    </div>
    @endif
  </div>
</section> 

@endsection


@section('script')

 @if($cate->type =="video")
  <script>
    (function($) {
    "use strict";
   
     $('#ch1').click(function(){
       $('#videoURL').show();
       $('#videoUpload').hide();
       $('#iframeURLBox').hide();
     });
    
    $('#ch2').click(function(){
       $('#videoURL').hide();
       $('#videoUpload').show();
       $('#iframeURLBox').hide();
     });

    $('#ch9').click(function(){
       $('#iframeURLBox').show();
       $('#videoURL').hide();
       $('#videoUpload').hide();
     });

    })(jQuery);
   
  </script>
 @endif

 @if($cate->type =="image")
  <script>
    (function($) {
    "use strict";
   
     $('#ch3').click(function(){
       $('#imageURL').show();
       $('#imageUpload').hide();
     });
    
    $('#ch4').click(function(){
       $('#imageURL').hide();
       $('#imageUpload').show();

     });

  })(jQuery);
  </script>
 @endif

 @if($cate->type =="zip")
  <script>
    (function($) {
    "use strict";
   
     $('#ch5').click(function(){
       $('#zipURL').show();
       $('#zipUpload').hide();
     });
    
    $('#ch6').click(function(){
       $('#zipURL').hide();
       $('#zipUpload').show();
     });

  })(jQuery);
   
  </script>
 @endif
@endsection
