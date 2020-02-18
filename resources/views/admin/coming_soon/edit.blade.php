@extends('admin.layouts.master')
@section('title', 'Coming Soon - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
      <div class="row">
        <div class="col-xs-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">Coming Soon</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ action('ComingSoonController@update') }}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}
						
		                <div class="row">
		                  <div class="col-md-6">
		                    <label for="bg_image">Background Image<sup class="redstar">*</sup></label>
		                    <input type="file" name="bg_image" id="bg_image">
		                    <br>
		                    <img src="{{ url('/images/comingsoon/'.$comingsoon['bg_image']) }}" class="img-responsive"/>
		                    
		                  </div>
		                  <div class="col-md-6">
		                    <label for="heading">Heading<sup class="redstar">*</sup></label>
		                    <input value="{{ $comingsoon['heading'] }}" name="heading" type="text" class="form-control" placeholder="Enter Page Title" required/>
		                    <br>
		                    <label for="btn_text">Button Text<sup class="redstar">*</sup></label>
		                    <input value="{{ $comingsoon['btn_text'] }}" name="btn_text" type="text" class="form-control" placeholder="Enter Button Text" required/>

		                  </div>
		              	</div>
		              	<br>
		              	<div class="row">
		                  <div class="col-md-3">
		                    <label for="count_one">Counter One<sup class="redstar">*</sup></label>
		                    <input value="{{ $comingsoon['count_one'] }}" name="count_one" type="text" class="form-control" placeholder="Enter Count" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="count_two">CounterTwo<sup class="redstar">*</sup></label>
		                    <input value="{{ $comingsoon['count_two'] }}" name="count_two" type="text" class="form-control" placeholder="Enter Count" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="count_three">Counter Three<sup class="redstar">*</sup></label>
		                    <input value="{{ $comingsoon['count_three'] }}" name="count_three" type="text" class="form-control" placeholder="Enter Count" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="count_four">Counter Four<sup class="redstar">*</sup></label>
		                    <input value="{{ $comingsoon['count_four'] }}" name="count_four" type="text" class="form-control" placeholder="Enter Count" required/>
		                  </div>
		              	</div>
		              	<br>

		              	<div class="row">
		                  <div class="col-md-3">
		                    <label for="text_one">Counter Text One<sup class="redstar">*</sup></label>
		                    <input value="{{ $comingsoon['text_one'] }}" name="text_one" type="text" class="form-control" placeholder="Enter Count" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="text_two">Counter Text Two<sup class="redstar">*</sup></label>
		                    <input value="{{ $comingsoon['text_two'] }}" name="text_two" type="text" class="form-control" placeholder="Enter Count" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="text_three">Counter Text Three<sup class="redstar">*</sup></label>
		                    <input value="{{ $comingsoon['text_three'] }}" name="text_three" type="text" class="form-control" placeholder="Enter Count" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="text_four">Counter Text Four<sup class="redstar">*</sup></label>
		                    <input value="{{ $comingsoon['text_four'] }}" name="text_four" type="text" class="form-control" placeholder="Enter Count" required/>
		                  </div>
		              	</div>
		              	<br>
						
						<div class="box-footer">
		              		<button value="" type="submit" class="btn btn-lg col-md-3 btn-primary">Save</button>
		              	</div>
		          	</form>
	          	</div>
	      	</div>
      	</div>
  	</div>
</section>
@endsection


