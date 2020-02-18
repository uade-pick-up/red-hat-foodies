@extends('admin.layouts.master')
@section('title', 'Bank Detail - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
	<div class="row">
        <div class="col-xs-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">Update Bank Detail</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ action('BankTransferController@update') }}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}
		                
		              	<div class="row">
		                  <div class="col-md-8 col-md-offset-2">
		                  	<div class="form-group">
			                    <label for="name">Account Holder Name<sup class="redstar">*</sup></label>
			                    <input value="{{ $show['account_holder_name'] }}" name="account_holder_name" type="text" class="form-control" placeholder="Enter account name" autocomplete="off"/>
			                </div>
		                  </div>
		                
		                  <div class="col-md-8 col-md-offset-2">
		                  	<div class="form-group">
			                    <label for="bank">Bank Name<sup class="redstar">*</sup></label>
			                    <input value="{{ $show['bank_name'] }}" name="bank_name" type="text" class="form-control" placeholder="Enter bank name" autocomplete="off"/>
			                </div>
		                  </div>
		               
		                  <div class="col-md-8 col-md-offset-2">
		                  	<div class="form-group">
			                    <label for="code">IFCS Code<sup class="redstar">*</sup></label>
			                    <input value="{{ $show['ifcs_code'] }}" name="ifcs_code" type="text" class="form-control" placeholder="Enter IFCS code" autocomplete="off"/>
			                </div>
		                  </div>
		               
		                  <div class="col-md-8 col-md-offset-2">
		                  	<div class="form-group">
			                    <label for="number">Account Number<sup class="redstar">*</sup></label>
			                    <input value="{{ $show['account_number'] }}" name="account_number" type="text" class="form-control" placeholder="Enter account number" autocomplete="off"/>
			                </div>
		                  </div>

		                </div>


		              	<br>
						<div class="box-footer">
		              		<button value="" type="submit" class="btn btn-md col-md-1 btn-primary">Save</button>
		              	</div>

		          	</form>
	          	</div>
	      	</div>
      	</div>
  	</div>
</section>
@endsection




