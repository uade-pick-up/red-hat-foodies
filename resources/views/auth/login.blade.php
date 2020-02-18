@section('title', 'Login')
@include('theme.head')

@include('admin.message')

<!-- end head -->
<!-- body start-->
<body>
<!-- top-nav bar start-->
<section id="nav-bar" class="nav-bar-main-block nav-bar-main-block-one">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="nav-bar-btn btm-20">
                    <a href="{{ url('/') }}" class="btn btn-secondary" title="Home"><i class="fa fa-chevron-left"></i>Back to home</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="logo text-center btm-10">
                    @php
                        $logo = App\Setting::first();
                    @endphp

                    @if($logo->logo_type == 'L')
                        <a href="{{ url('/') }}" title="logo"><img src="{{ asset('images/logo/'.$logo->logo) }}" class="img-fluid" alt="logo"></a>
                    @else()
                        <a href="{{ url('/') }}"><b><div class="logotext">{{ $logo->project_title }}</div></b></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="Login-btn txt-rgt">
                    <a href="{{ route('register') }}" class="btn btn-primary" title="instructor">Sign Up</a>
                </div> 
            </div>
        </div>
    </div>
    <hr>
</section>

<!-- top-nav bar end-->
<!-- Signup start-->
<section id="signup" class="signup-block-main-block">
    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="signup-heading">
                Log In to Your {{ $project_title }} Account!
            </div>

            <div class="signup-block">

                <div class="signin-link btm-10">
                    @if($gsetting->fb_login_enable == 1)
                        <a href="{{ url('/auth/facebook') }}" target="_blank" title="facebook" class="btn btn-info btm-10" title="Facebook"><i class="fa fa-facebook"></i>Continue with Facebook</a>
                    @endif
                    
                    @if($gsetting->google_login_enable == 1)
                    <div class="google">
                        <a href="{{ url('/auth/google') }}" target="_blank" title="google" class="btn btn-white btm-10" title="google"><i class="fab fa-google-plus-g"></i>Continue with Google</a>
                    </div>
                    @endif

                    @if($gsetting->gitlab_login_enable == 1)
                        <a href="{{ url('/auth/gitlab') }}" target="_blank" title="gitlab" class="btn btn-white" title="gitlab"><i class="fab fa-gitlab"></i>Continue with Git Lab</a>
                    @endif
                </div>

                <form method="POST" class="signup-form" action="{{ route('login') }}">
                    @csrf
                 
                    <div class="form-group">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter Your E-Mail"   name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter Your Password" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                        <br>
                        <br>

                        <div class="forgot-password text-center btm-20">or <a href="{{ 'password/reset' }}" title="sign-up">Forgot Password</a>
                        </div>

                    </div>


                    <div class="signin-link text-center btm-20">
                        By signing up, you agree to our <a href="{{url('terms_condition')}}" title="Policy">Terms of Use </a>and <a href="{{url('privacy_policy')}}" title="Policy">Privacy Policy.</a>
                    </div>
                    <hr>
                    <div class="sign-up text-center">Don't have an account?<a href="{{ route('register') }}" title="sign-up">  Sign up</a>
                    </div>
                            
                </form>
            </div>
        </div>
    </div>

</section>
<!--  Signup end-->
<!-- jquery -->
@include('theme.scripts')
<!-- end jquery -->
</body>
<!-- body end -->
</html> 






