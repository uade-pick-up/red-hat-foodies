@extends('admin.layouts.master')
@section('title', 'Privacy Policy - Admin')
@section('body')
 
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
    	<div class="box box-primary">
         	<div class="box-header with-border">
          	<h3 class="box-title">Privacy Policy</h3>
       		</div>
        	<div class="panel-body">
        		<form action="{{ action('TermsController@update') }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              
              <div class="row">
                <div class="col-md-12">
                  <label for="policy">Privacy Policy:<sup class="redstar">*</sup></label>
                  <textarea id="editor2" name="policy" rows="10" cols="80">
                  {{ $items['policy'] }}
                </textarea>
                </div>
              </div>
              <br>
              
              <div class="box-footer">
                <button value="" type="submit"  class="btn btn-md col-md-2 btn-primary">Save</button>
              </div>

            </form>
          </div>
      </div>
    </div>
  </div>
</section>
@endsection


@section('scripts')

<script>
(function($) {
  "use strict";
  $(function () {
    CKEDITOR.replace('editor2')
  })
})(jQuery);
</script>
@endsection
