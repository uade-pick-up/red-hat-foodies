@extends("admin/layouts.master")
@section('title','All Cities')
@section("body")

<section class="content">
	@include('admin.message')
	<div class="row">
	  <div class="col-xs-12">
	    <div class="box box-primary" >
	      	<div class="box-header with-border">
	        	<h3 class="box-title">City</h3>
	    	</div>
	        <div class="box-header">
	            <a href=" {{url('admin/city/create')}} " class="btn btn-info btn-sm">+ Add City</a> 
	        </div>       
		    <div class="box-body">
		    	<div class="table-responsive">
			        <table id="example1" class="table table-bordered table-striped table-responsive">

			          	<thead>
				            <tr class="table-heading-row">
				              <th>ID</th>
				              <th>City Name</th>
				              <th>State Name</th>
				              <th>Country Name</th>
				              <th>Delete</th>
				            </tr>
				          </thead>
			          	<tbody>
						<?php $i=0;?> 
		                @foreach ($cities as $city)

			                <tr>
			                  <?php $i++;?>
			                  <td><?php echo $i;?></td>
			                  <td>{{ $city->name }}</td>
			                  <td>{{ $city->state->name }}</td>
			                  <td>{{ $city->country->nicename }}</td>
			                  
			                 
			                  <td><form  method="post" action="{{url('admin/state/'.$city->id)}}
			                      "data-parsley-validate class="form-horizontal form-label-left">
			                      {{ csrf_field() }}
			                      {{ method_field('DELETE') }}
			                       <button  type="submit" class="btn btn-danger" onclick="return confirm('Delete This User..?)" ><i class="fa fa-fw fa-trash-o"></i></button></td>
			                      </form>
			                  </td>
			                </tr>
		                @endforeach
		            
			          </tbody>
			        </table>
		    	</div>
	      	</div>
	      	<!-- /.box-body -->
	    </div>
	  </div>
	</div>
</section>
@endsection

  

