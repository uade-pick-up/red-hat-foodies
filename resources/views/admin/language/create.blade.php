@extends('admin/layouts.master')
@section('body')
@section("title","Add Language")

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">Add Language</h3>
        </div>
        <div class="panel-body">


          <form id="demo-form2" method="post" action="{{action('LanguageController@store')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
            
              <div class="row">
                <div class="col-md-5">
                  <label for="local">Local:<sup class="redstar">*</sup></label>
                  <input class="form-control" type="text" name="local" placeholder="Please enter language local name" required>
                </div>
                <div class="col-md-5">
                  <label for="name">Name:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="name" id="sub_heading" placeholder="Please enter language name eg:English" required>
                </div>
                <div class="col-md-2">
                  <label for="">Set Default</label>
                  <br>
                  <label class="switch">
                         <input name="def" type="checkbox" class="checkbox-switch" id="logo_chk">
                        <span class="slider round"></span>
                    </label>
                </div>
              </div>
              <br>
              
              <div class="box-footer">
                <button type="submit" class="btn btn-md btn-primary">+ Add Language</button>
              </div>
         
            </form>
        </div>
        <!-- /.panel body -->
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section> 

@endsection

