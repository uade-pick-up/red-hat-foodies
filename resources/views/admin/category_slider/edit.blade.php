@extends('admin.layouts.master')
@section('title', 'Category Slider - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
	<div class="row">
        <div class="col-md-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              		<h3 class="box-title">Category Slider</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ action('CategorySliderController@update') }}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}
						
		                <div class="row">
		                  <div class="col-md-6">
		                  	<div class="form-group">
			                  <label for="heading">Categories</label>
			                  <select class="form-control js-example-basic-single" name="category_id[]" multiple="multiple" size="3" >

		                      @foreach ($category as $cat)
								@if($cat->status == 1)
		                        <option value="{{ $cat->id }}" {{in_array($cat->id, $category_slider['category_id'] ?: []) ? "selected": ""}}>{{ $cat->title }}
		                        </option>
		                        @endif

		                      @endforeach

		                    </select>
		                	</div>
		                  </div>
		                  <div class="col-md-6">
		                  	<div class="form-group">
		                      <input value="1" name="category_to_show" type="hidden" class="form-control" />
		                	</div>
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

