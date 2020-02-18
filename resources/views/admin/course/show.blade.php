@extends('admin/layouts.master')
@section('title', 'Edit Course - Admin')
@section('body')

<div class="box">
  <div class="box-header">
    <h3 >{{$cor->title }}</h3>
  </div>
  <div class="box-body">
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  </div>    
</div>

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        <div class="content-header">
        </div>
        <div class="box-body">
          <div class="nav-tabs-custom">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="nav-tab" role="tablist">
              <li role="presentation" class="active"><a href="#a" aria-controls="home" role="tab" data-toggle="tab">Course</a></li>
              <li class=""  role="presentation"><a href="#b" aria-controls="profile" role="tab" data-toggle="tab">Course Include</a></li>
              <li  class=""  role="presentation"><a href="#c" aria-controls="messages" role="tab" data-toggle="tab">What Learns</a></li>
              <li  class=""  role="presentation"><a href="#d" aria-controls="settings" role="tab" data-toggle="tab">Course Chapter</a></li>
              <li  class=""  role="presentation"><a href="#e" aria-controls="settings" role="tab" data-toggle="tab">Course Class</a></li>
              <li  class=""  role="presentation"><a href="#market" aria-controls="settings" role="tab" data-toggle="tab">Related Course</a></li>
              <li  class=""  role="presentation"><a href="#copy" aria-controls="settings" role="tab" data-toggle="tab">Question</a></li>
              <li  class=""  role="presentation"><a href="#ans" aria-controls="settings" role="tab" data-toggle="tab">Answer</a></li>
              <li  class=""  role="presentation"><a href="#jj" aria-controls="settings" role="tab" data-toggle="tab">Review & Rating</a></li>
              <li  class=""  role="presentation"><a href="#an" aria-controls="settings" role="tab" data-toggle="tab">Announcements</a></li>
              <li  class=""  role="presentation"><a href="#report" aria-controls="settings" role="tab" data-toggle="tab">Review Report</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade in active" id="a">
                @include('admin.course.editcor')
              </div>
              <div role="tabpanel" class="tab-pane fade" id="b">
                @include('admin.course.courseinclude.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="c">
                @include('admin.course.whatlearns.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="d">
                @include('admin.course.coursechapter.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="e">
                @include('admin.course.courseclass.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="market">
                @include('admin.course.relatedcourse.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="copy">
                @include('admin.course.questionanswer.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="ans">
                @include('admin.course.answer.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="jj">
                @include('admin.course.reviewrating.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="an">
                @include('admin.course.announsment.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="report">
                @include('admin.course.reviewreport.index')
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection


@section('custom-script')

<script>
(function($) {
"use strict";
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#nav-tab a[href="' + activeTab + '"]').tab('show');
    }
  });
})(jQuery);
</script>

@endsection
  