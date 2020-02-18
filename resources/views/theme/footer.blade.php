<footer id="footer" class="footer-main-block">
    <div class="container-fluid">
        <div class="footer-block">
            <div class="row">
                @php
                    $widgets = App\WidgetSetting::first();
                @endphp
                @if(isset($widgets))

                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_one }}</b></div>
                    <div class="footer-link">
                        <ul>
                            @if($gsetting->instructor_enable == 1)
                                @if(Auth::check())
                                    @if(Auth::User()->role == "user")
                                    <li><a href="#" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor">Become an instructor</a></li>
                                    @endif
                                @else
                                    <li><a href="{{ route('login') }}" title="Become an instructor">Become an instructor</a></li>
                                @endif
                            @endif
                            <li><a href="{{ route('about.show') }}" title="About">About us</a></li>
                            @if(Auth::check())
                                <li><a href="{{url('user_contact')}}" title="About">Contact us</a></li>
                            @else
                                <li><a href="{{ route('login') }}" title="Contact Us">Contact us</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_two }}</b></div>
                    <div class="footer-link">
                        <ul>
                            <li><a href="{{ route('careers.show') }}" title="Careers">Careers</a></li>
                            <li><a href="{{ route('blog.all') }}" title="Blog">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_three }}</b></div>
                    <div class="footer-link">
                        <ul>
                            <li><a href="{{ route('help.show') }}" title="link">Help & Support</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    @php
                        $languages = App\Language::all(); 
                    @endphp
                    @if(isset($languages) && count($languages) > 0)
                    <div class="footer-dropdown txt-rgt">
                        <a href="#" class="a" data-toggle="dropdown"><i class="fa fa-globe rgt-15"></i>{{Session::has('changed_language') ? ucfirst(Session::get('changed_language')) : ''}}<i class="fa fa-angle-up lft-10"></i></a>
                        <ul class="dropdown-menu">
                            
                            @foreach($languages as $language)
                            <li><a href="{{ route('languageSwitch', $language->local) }}">{{$language->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
        <div class="footer-local-page">
            <ul>
                @php
                    $languages = App\Language::all(); 
                @endphp
                @if(isset($languages) && count($languages) > 0)
                    <li class="active"><a href="#"><b>Local Home Pages:</b></a></li>
                
                    @foreach($languages as $language)
                    <li><a href="{{ route('languageSwitch', $language->local) }}">{{$language->name}}</a></li>
                    @endforeach
                @endif
            </ul> 
        </div>
    </div>
    <hr>
    <div class="tiny-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo-footer">
                        <ul>
                            @php
                                $logo = App\Setting::first();
                            @endphp
                            <li>
                                @if($logo->logo_type == 'L')
                                    <a href="{{ url('/') }}" title="logo"><img src="{{ asset('images/logo/'.$logo->logo) }}" alt="logo" class="img-fluid" ></a>
                                @else()
                                    <a href="{{ url('/') }}"><b>{{ $logo->project_title }}</b></a>
                                @endif
                            </li>

                            <li>{{ $cpy_txt }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="copyright-social">
                        <ul>
                            <li><a href="{{url('terms_condition')}}" title="Terms">Terms & Condition</a></li> 
                            <li><a href="{{url('privacy_policy')}}" title="Policy">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@include('instructormodel')
