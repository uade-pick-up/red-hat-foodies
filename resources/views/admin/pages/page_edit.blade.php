@extends('admin/layouts.master')
@section('title', 'Edit Page - Admin')
@section('body')
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
    <!-- left column -->
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> Edit - {!! $find->title !!}</h3>
        </div>
        <div class="box-body">
          <div class="form-group">              
            <form id="demo-form2" method="post" action="{{url('page/'.$find->id)}}" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data">
              {{ csrf_field() }}
              {{method_field('PATCH')}}

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputName">Title:</label>
                  <input type="text" class="form-control" name="title" id="exampleInputTitle"value="{{$find->title}}">
                </div>
                <div class="col-md-6">
                  <label for="exampleInputSlug">Slug:</label>
                  <input type="text" class="form-control" name="slug" id="exampleInputPassword1" value="{{$find->slug}}">
                </div>
                
              </div>
              <br>

              <div class="row">
                <div class="col-md-6">
                   <label for="exampleInputDetails">Details:</label>
                  <textarea name="details" rows="3" class="form-control" >{{$find->details}}</textarea>
                </div>
                <div class="col-md-6">
                  <label for="exampleInputTit1e">Status:</label>
                  <li class="tg-list-item">
                    <input class="tgl tgl-skewed" id="cb10" type="checkbox" {{ $find->status==1 ? 'checked' : '' }}>
                    <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb10"></label>
                  </li>
                  <input type="hidden" name="status" value="{{ $find->status }}" id="j">
                </div>
              </div>
              <br>

              <div class="box-footer">
                <button type="submit" class="btn btn-md col-md-2 btn-primary">Save</button>
              </div>
            </form>
          </div>
       
        </div>
        <!-- /.box -->
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section> 
@endsection
