@extends('theme.master')
@section('title', 'Profile & Setting')
@section('content')

@include('admin.message')

<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">User Profile</h1>
    </div>
</section> 
<!-- profile update start -->
<section id="profile-item" class="profile-item-block">
    <div class="container">
    	<form action="{{ route('user.profile',$orders->id) }}" method="POST" enctype="multipart/form-data">
        	{{ csrf_field() }}
            {{ method_field('PUT') }}

	        <div class="row">
	            <div class="col-xl-3 col-lg-4">
	                <div class="dashboard-author-block text-center">
	                    <div class="author-image">
						    <div class="avatar-upload">
						        <div class="avatar-edit">
						            <input type='file' id="imageUpload" name="user_img" accept=".png, .jpg, .jpeg" />
						            <label for="imageUpload"><i class="fa fa-pencil"></i></label>
						        </div>
						        <div class="avatar-preview">
						        	@if(Auth::User()->user_img != null || Auth::User()->user_img !='')
							            <div class="avatar-preview-img" id="imagePreview" style="background-image: url({{ url('/images/user_img/'.Auth::User()->user_img) }});">
							            </div>
							        @else
							        	<div class="avatar-preview-img" id="imagePreview" style="background-image: url({{ asset('images/default/user.jpg')}});">
							            </div>
							        @endif
						        </div>
						    </div>
	                    </div>
	                    <div class="author-name">{{ Auth::User()->fname }}&nbsp;{{ Auth::User()->lname }}</div>
	                </div>
	                <div class="dashboard-items">
	                    <ul>
	                        <li><i class="fa fa-bookmark"></i><a href="{{ route('mycourse.show') }}" title="Dashboard">My Course</a></li>
	                        <li><i class="fa fa-heart"></i><a href="{{ route('wishlist.show') }}" title="Profile Update">My Wishlist</a></li>
	                        <li><i class="fa fa-history"></i><a href="{{ route('purchase.show') }}" title="Followers">Purchase History</a></li>
	                        <li><i class="fa fa-user"></i><a href="{{route('profile.show',Auth::User()->id)}}" title="Upload Items">User Profile</a></li>
	                        @if(Auth::User()->role == "user")
	                        <li><i class="fas fa-chalkboard-teacher"></i><a href="#" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor">Become An Instructor</a></li>
	                        @endif
	                    </ul>
	                </div>
	            </div>
	            <div class="col-xl-9 col-lg-8">

	                <div class="profile-info-block">
	                    <div class="profile-heading">Personal Information</div>
	                    <div class="row">
	                        <div class="col-lg-6">
	                            <div class="form-group">
	                                <label for="name">First Name</label>
	                                <input type="text" id="name" name="fname" class="form-control" placeholder="Enter First Name" value="{{ $orders->fname }}">
	                            </div>
	                            <div class="form-group">
	                                <label for="email">Email</label>
	                                <input type="email" id="email" name="email" class="form-control" placeholder="info@example.com" value="{{ $orders->email }}" >
	                            </div>
	                            <div class="form-group">
	                                <label for="email">Date of Birth</label>
	                                <input type="date" id="date" name="dob" class="form-control" placeholder="" value="{{ $orders->dob }}" >
	                            </div>
	                        </div>
	                        <div class="col-lg-6">
	                            <div class="form-group">
	                                <label for="Username">Last Name</label>
	                                <input type="text" id="lname" name="lname" class="form-control" placeholder="Enter Last Name" value="{{ $orders->lname }}">
	                            </div>
	                            <div class="form-group">
	                                <label for="mobile">Mobile No.</label>
	                                <input type="text" id="mobile" value="{{ $orders->mobile }}" class="form-control" placeholder="Enter Mobile No.">
	                            </div>
	                            <div class="form-group">
					               <label for="gender">Choose Gender:</label>
					                <br>
					                <input type="radio" name="gender" id="ch1" value="m" {{ $orders->gender == 'm' ? 'checked' : '' }}> Male
					                <br>
					                <input type="radio" name="gender" id="ch2" value="f" {{ $orders->gender == 'f' ? 'checked' : '' }}> Female
					                <br>
					                <input type="radio" name="gender" id="ch3" value="o" {{ $orders->gender == 'o' ? 'checked' : '' }}> Other
					            </div>

	                            
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-lg-4">
	                        	<div class="form-group">
	                                <label for="city_id">Country:</label>
					                <select id="country_id" class="form-control js-example-basic-single" name="country_id">
					                  <option value="none" selected disabled hidden> 
					                      Select an Option 
					                    </option>
					                  
					                  @foreach ($countries as $coun)
					                    <option value="{{ $coun->country_id }}" {{ $orders->country_id == $coun->id ? 'selected' : ''}}>{{ $coun->nicename }}
					                    </option>
					                  @endforeach
					                </select>
	                            </div>
	                        </div>
	                        <div class="col-lg-4">
	                        	<div class="form-group">
	                        		<label for="city_id">State:</label>
					                <select id="upload_id" class="form-control js-example-basic-single" name="state_id">
					                  <option value="none" selected disabled hidden> 
					                    Select an Option 
					                  </option>
					                  @foreach ($states as $s)
					                    <option value="{{ $s->id}}" {{ $orders->state_id==$s->id ? 'selected' : '' }}>{{ $s->name}}</option>
					                  @endforeach

					                </select>
	                        	</div>
	                        </div>
	                        <div class="col-lg-4">
	                        	<div class="form-group">
	                        		<label for="city_id">City:</label>
					                <select id="grand" class="form-control js-example-basic-single" name="city_id">
					                  <option value="none" selected disabled hidden> 
					                    Select an Option 
					                  </option>
					                  @foreach ($cities as $c)
					                    <option value="{{ $c->id }}" {{ $orders->city_id == $c->id ? 'selected' : ''}}>{{ $c->name }}
					                    </option>
					                  @endforeach
					                </select>
	                        	</div>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label for="bio">Author Bio</label>
	                        <textarea id="detail" name="detail" class="form-control" placeholder="Enter your details" value="">{{ $orders->detail }}</textarea>
	                    </div>
	                    <br>

	                    <div class="row">
		                    <div class="col-lg-12">
		                      <div class="update-password">
		                        <label for="box1"><b>Update Password :</b></label>
		                        <input type="checkbox" id="myCheck"  onclick="myFunction()">
		                      </div>
		                    </div>
		                </div>
		                <div class="password display-none" id="update-password">
			                <div class="row">
				                <div class="col-lg-6">
					                <div class="form-group">
						                <label for="confirmpassword">Password :</label>
										  <input name="password" class="form-control" id="password" type="password" placeholder="Enter Password" onkeyup='check();' />
										</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Confirm Password:</label>
										  <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" onkeyup='check();' /> 
										  <span id='message'></span>
										</label>
									</div>
								</div>
							</div>
		            	</div>
		                <br>
	                </div>
	                <div class="social-profile-block">
	                    <div class="social-profile-heading">Social Profiles</div>
	                    <div class="row">
	                        <div class="col-lg-6">
	                            <div class="social-block">
	                                <div class="form-group">
	                                    <label for="facebook">Facebook</label><br>
	                                    <div class="row">
	                                        <div class="col-lg-2 col-2">
	                                            <div class="profile-update-icon">
	                                                <div class="product-update-social-icons"><a href="{{ $orders->fb_url }}" target="_blank" title="facebook"><i class="fa fa-facebook facebook"></i></a>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="col-lg-10 col-10">
	                                            <input type="text" name="fb_url" value="{{ $orders->fb_url }}" id="facebook" class="form-control" placeholder="Facebook.com/">
	                                        </div>
	                                    </div>    
	                                </div>
	                            </div>
	                            <div class="social-block">
	                                <div class="form-group">
	                                    <label for="behance2">Youtube</label><br>
	                                    <div class="row">
	                                        <div class="col-lg-2 col-2">
	                                            <div class="profile-update-icon">
	                                                <div class="product-update-social-icons"><a href="{{ $orders->youtube_url }}" target="_blank" title="googleplus"><i class="fab fa-youtube youtube"></i></a>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="col-lg-10 col-10">
	                                            <input type="text" name="youtube_url" value="{{ $orders->youtube_url }}" id="behance2" class="form-control" placeholder="youtube.com/">
	                                        </div>
	                                    </div>    
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-6">
	                            <div class="social-block">
	                                <div class="form-group">
	                                    <label for="twitter">Twitter</label><br>
	                                    <div class="row">
	                                        <div class="col-lg-2 col-2">
	                                            <div class="profile-update-icon">
	                                                <div class="product-update-social-icons"><a href="{{ $orders->twitter_url }}" target="_blank" title="twitter"><i class="fab fa-twitter twitter"></i></a>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="col-lg-10 col-10">
	                                            <input type="text" name="twitter_url" value="{{ $orders->twitter_url }}" id="twitter" class="form-control" placeholder="Twitter.com/">
	                                        </div>
	                                    </div>    
	                                </div>
	                            </div>
	                            <div class="social-block">
	                                <div class="form-group">
	                                    <label for="dribbble2">LinkedIn</label><br>
	                                    <div class="row">
	                                        <div class="col-lg-2 col-2">
	                                            <div class="profile-update-icon">
	                                                <div class="product-update-social-icons"><a href="{{ $orders->linkedin_url }}" target="_blank" title="linkedin"><i class="fab fa-linkedin-in linkedin"></i></a>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="col-lg-10 col-10">
	                                            <input type="text" name="linkedin_url" value="{{ $orders->linkedin_url }}" id="dribbble2" class="form-control" placeholder="Linkedin.com/">
	                                        </div>
	                                    </div>    
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>

	                <div class="upload-items text-right">
	                    <button type="submit" class="btn btn-primary" title="upload items">Update Profile</button>
	                </div>
	                
	            </div>
	        </div>

        </form>
    </div>
</section>
<!-- profile update end -->
@endsection

@section('custom-script')

<script>
(function($) {
  "use strict";
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
  })(jQuery);

</script>

<script>
(function($) {
  "use strict";
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
(function($) {
  "use strict";
	function readURL(input) {
	if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
	        $('#imagePreview').hide();
	        $('#imagePreview').fadeIn(650);
	    }
	    reader.readAsDataURL(input.files[0]);
		}
	}
	$("#imageUpload").change(function() {
	    readURL(this);
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

<script>
(function($) {
  "use strict";
	$('#password, #confirm_password').on('keyup', function () {
	  if ($('#password').val() == $('#confirm_password').val()) {
	    $('#message').html('Password Match').css('color', 'green');
	  } else 
	    $('#message').html('Password Do Not Match').css('color', 'red');
	});
})(jQuery);

</script>

<script>
(function($) {
  "use strict";
	tinymce.init({selector:'textarea#detail'});
})(jQuery);
</script>

@endsection
