@extends('admin.layouts.master')
@section('title', 'Edit User - Admin')
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
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Users</h3>

          
        </div>
        <br>
        <div class="panel-body">
          <form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">
              <div class="col-md-6">
                <label for="fname">
                  First Name:
                  <sup class="redstar">*</sup>
                </label>
                <input value="{{ $user->fname }}" autofocus required name="fname" type="text" class="form-control" placeholder="Enter first name"/>
              </div>

              <div class="col-md-6">
                <label for="lname">
                  Last Name:
                  <sup class="redstar">*</sup>
                </label>
                <input value="{{ $user->lname }}" required name="lname" type="text" class="form-control" placeholder="Enter last name"/>
              </div>
            </div>
            <br>

            <div class="row">

              <div class="col-md-6">
                <label for="mobile">Mobile No.<sup class="redstar">*</sup></label>
                <input value="{{ $user->mobile }}" required type="text" name="mobile" placeholder="Enter mobile no" class="form-control">
               </div>
               <div class="col-md-6">
                <label for="mobile">Email:<sup class="redstar">*</sup> </label>
                <input value="{{ $user->email }}" required type="email" name="email" placeholder="Enter email" class="form-control">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                  <label for="address">Address:<sup class="redstar">*</sup> </label>
                  <textarea name="address" class="form-control" rows="1" required  placeholder="Enter adderss" value="">{{ $user->address }}</textarea>
              </div>

              <div class="col-md-6">
                <label for="dob">Date of Birth: </label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" value="{{ $user->dob }}" name="dob" required class="form-control pull-right" id="datepicker" placeholder="Enter your date of birth">
                </div>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
               <label for="gender">Choose Gender:</label>
                <br>
                <input type="radio" name="gender" id="ch1" value="m" {{ $user->gender == 'm' ? 'checked' : '' }}> Male
                <input type="radio" name="gender" id="ch2" value="f" {{ $user->gender == 'f' ? 'checked' : '' }}> Female
                <input type="radio" name="gender" id="ch3" value="o" {{ $user->gender == 'o' ? 'checked' : '' }}> Other
              </div>

              <div class="col-md-6">
                <label for="role">Choose Role:</label>
                  @if(Auth::User()->role=="admin")
                  <select class="form-control js-example-basic-single" name="role">
                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">User</option>
                    <option {{ $user->role == 'admin' ? 'selected' : ''}} value="admin">Admin</option>
                    <option {{ $user->role == 'instructor' ? 'selected' : ''}} value="instructor">Instructor</option>
                  </select>
                  @endif
                  @if(Auth::User()->role=="instructor")
                  <select class="form-control js-example-basic-single" name="role">
                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">User</option>
                    <option {{ $user->role == 'instructor' ? 'selected' : ''}} value="instructor">Instructor</option>
                  </select>
                  @endif
                  @if(Auth::User()->role=="user")
                  <select class="form-control js-example-basic-single" name="role">
                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">User</option>
                  </select>
                  @endif
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-3">
                <label for="city_id">Country:</label>
                <select id="country_id" class="form-control js-example-basic-single" name="country_id">
                  <option value="none" selected disabled hidden> 
                      Select an Option 
                    </option>
                  
                  @foreach ($countries as $coun)
                    <option value="{{ $coun->country_id }}" {{ $user->country_id == $coun->country_id ? 'selected' : ''}}>{{ $coun->nicename }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-3">
                <label for="city_id">State:</label>
                <select id="upload_id" class="form-control js-example-basic-single" name="state_id">
                  <option value="none" selected disabled hidden> 
                    Select an Option 
                  </option>
                  @foreach ($states as $s)
                    <option value="{{ $s->id}}" {{ $user->state_id==$s->id ? 'selected' : '' }}>{{ $s->name}}</option>
                  @endforeach

                </select>
              </div>

              <div class="col-md-3">
                <label for="city_id">City:</label>
                <select id="grand" class="form-control js-example-basic-single" name="city_id">
                  <option value="none" selected disabled hidden> 
                    Select an Option 
                  </option>
                  @foreach ($cities as $c)
                    <option value="{{ $c->id }}" {{ $user->city_id == $c->id ? 'selected' : ''}}>{{ $c->name }}
                    </option>
                  @endforeach
                </select>
              </div>
          
              <div class="col-md-3">
                <label for="pin_code">Pincode:</label>
                <input value="{{ $user->pin_code }}" placeholder="Enter Pincode" type="text" name="pin_code" class="form-control">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-3">
                <label for="exampleInputTit1e">Verified:</label>
                <li class="tg-list-item">
                  <input class="tgl tgl-skewed" id="c033"   type="checkbox"  {{ $user->verified==1 ? 'checked' : '' }}>
                <label class="tgl-btn" data-tg-off="No" data-tg-on="Yes" for="c033"></label>
                </li>
                <input type="hidden" name="verified" value="{{ $user->varified }}" id="tt">
              </div>

              <div class="col-md-3">
                <label for="exampleInputTit1e">Status:</label>
                <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $user->status == '1' ? 'checked' : '' }} >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
              </li>
              <input type="hidden"  name="free" value="0" for="status" id="status">
              </div>


              <div class="col-md-3">
                  <label  for="married_status">Choose Marrige Status: </label>
                  <select class="form-control js-example-basic-single" id="married_status" name="married_status">
                    <option value="none" selected disabled hidden> 
                      Select an Option 
                    </option> 
                    <option id="Unmarried" {{ $user->married_status == 'Unmarried' ? 'selected' : ''}} value="Unmarried">Unmarried</option>
                    <option id="Married" {{ $user->married_status == 'Married' ? 'selected' : ''}} value="Married">Married</option>
                    <option id="Divorced" {{ $user->married_status == 'Divorced' ? 'selected' : ''}} value="Divorced">Divorced</option>
                    <option id="Widowed" {{ $user->married_status == 'Widowed' ? 'selected' : ''}} value="Widowed">Widowed</option>
                  </select>
                  <br> 
              </div>


              <div class="col-md-3 display-none" id="doaboxxx">
                <label for="dob">Date of Anniversary: </label>
                <input value="{{ $user->doa }}" name="doa" id="doa" type="text" class="form-control" placeholder="Enter Date of anniversary">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label>Choose image:<sup class="redstar">*</sup></label>
                <input type="file" name="user_img" class="form-control">
              </div>
              <div class="col-md-6">
                @if($user->user_img != null || $user->user_img !='')
                  <div class="edit-user-img">
                    <img src="{{ url('/images/user_img/'.$user->user_img) }}" class="img-fluid" alt="User Image" class="img-responsive">
                  </div>
                @else
                  <div class="edit-user-img">
                    <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="User Image" class="img-responsive">
                  </div>
                @endif
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-12">
                <div class="update-password">
                  <label for="box1">Update Password :</label>
                  <input type="checkbox" id="myCheck" name="update_pass" onclick="myFunction()">
                </div>
              </div>
            </div>

            <div class="row display-none" id="update-password">
              <div class="col-md-6">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password">
              </div>
              <div class="col-md-6">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm password">
              </div>
            </div>
            <br>


            <div class="row">
              <div class="col-md-12">
                <label for="detail">Detail:<sup class="redstar">*</sup></label>
                <textarea id="detail" name="detail" class="form-control" rows="5" placeholder="Enter your details" value="">{{ $user->detail }}</textarea>
              </div>
            </div>
            <br>

            <div class="box-header with-border">
              <h3 class="box-title">Social Profile</h3>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label for="fb_url">
                Facebook Url:
                </label>
                <input autofocus name="fb_url" value="{{ $user->fb_url }}" type="text" class="form-control" placeholder="Facebook.com/"/>
              </div>
              <div class="col-md-6">
                <label for="youtube_url">
                Youtube Url:
                </label>
                <input autofocus name="youtube_url" value="{{ $user->youtube_url }}" type="text" class="form-control" placeholder="youtube.com/"/>
                <br>
              </div>
            
              <div class="col-md-6">
                <label for="twitter_url">
                Twitter Url:
                </label>
                <input autofocus name="twitter_url" value="{{ $user->twitter_url }}" type="text" class="form-control" placeholder="Twitter.com/"/>
              </div>
              <div class="col-md-6">
                <label for="linkedin_url">
                LinkedIn Url:
                </label>
                <input autofocus name="linkedin_url" value="{{ $user->linkedin_url }}" type="text" class="form-control" placeholder="Linkedin.com/"/>
              </div>
            </div>
            <br>
            <br>
            

            <div class="box-footer">
              <button type="submit" class="btn btn-md btn-primary">
                <i class="fa fa-save"></i> Update User
              </button>
            </form>
              <a href="{{ route('user.index') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
                <i class="fa fa-reply"></i> Back
              </a>
            </div>
            <br>

          </form>
        </div>
        <!-- /.panel body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection

@section('scripts')

<script>
(function($) {
  "use strict";

  $( function() {
    $( "#dob,#doa" ).datepicker({
      changeYear: true,
      yearRange: "-100:+0",
      dateFormat: 'yy/mm/dd',
    });
  });
  

  $('#married_status').change(function() {
      
    if($(this).val() == 'Married')
    {
      $('#doaboxxx').show();
    }
    else
    {
      $('#doaboxxx').hide();
    }
  });

  tinymce.init({selector:'textarea#detail'});

  $(function() {
    var urlLike = '{{ url('country/dropdown') }}';
    $('#country_id').change(function() {
      var up = $('#upload_id').empty();
      var cat_id = $(this).val();    
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){   
            console.log(data);
            up.append('<option value="0">Please Choose</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          }
        });
      }
    });
  });

  $(function() {
    var urlLike = '{{ url('country/gcity') }}';
    $('#upload_id').change(function() {
      var up = $('#grand').empty();
      var cat_id = $(this).val();    
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){   
            console.log(data);
            up.append('<option value="0">Please Choose</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          }
        });
      }
    });
  });

})(jQuery);
</script>

<script>
  function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("update-password");
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
       text.style.display = "none";
    }
  }
</script>

@endsection

