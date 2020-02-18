@extends('theme.master')
@section('title', "$course->title")
@section('content')

@include('admin.message')
<!-- courses content header start -->
<section id="udemy-courses-home" class="udemy-courses-home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="udemy-courses-home-video text-white btm-30">
                    <div class="video-item hidden-xs">
                        <div class="video-device">
                            <img src="{{ asset('images/course/'.$course->preview_image) }}" class="img-fluid" alt="Background">
                            <div class="video-preview">

                                @if($course->chapter[0]->courseclass[0]->iframe_url == NULL)
                                    <a href="{{ route('watchcourse',$course->id) }}" class="btn-video-play iframe"><i class="fa fa-play"></i></a>
                                @else
                                    @php
                                        $url = Crypt::encrypt($course->chapter[0]->courseclass[0]->iframe_url);
                                    @endphp
                                    <a href=" {{ route('watchinframe',[$url, 'course_id' => $course->id]) }}" class="btn-video-play"><i class="fa fa-play"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="udemy-courses-home-block text-white">
                    <h3 class="udemy-courses-home-heading btm-20"><a href="#" title="heading">{{ $course->title }}</a></h3>
                    <div class="udemy-courses btm-20">{{ $course->user->fname }}</div>
                    <div class="udemy-courses btm-20">{{ $course->short_detail }}</div>

                    @if($course->chapter[0]->courseclass[0]->iframe_url == NULL)
                    <div class="udemy-courses-home-btn">
                        <a href="{{ route('watchcourse',$course->id) }}" class="iframe btn btn-primary" title="Continue">Continue to Lecture</a>
                    </div>
                    @else
                    <div class="udemy-courses-home-btn">
                        @php
                            $url = Crypt::encrypt($course->chapter[0]->courseclass[0]->iframe_url);
                        @endphp
                        <a href="{{ route('watchinframe',[$url, 'course_id' => $course->id]) }}" class="btn btn-primary" title="Continue">Continue to Lecture</a>
                    </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</section>
<!-- courses content header end -->
<!-- courses-content start -->
<section id="udemy-courses" class="udemy-courses-about-main-block">
    <div class="container">
        <div class="about-block">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active text-center" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Overview</a>
                    <a class="nav-item nav-link text-center" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Course Content</a>
                    <a class="nav-item nav-link text-center" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Q &amp; A</a>
                    <a class="nav-item nav-link text-center" id="nav-announcement-tab" data-toggle="tab" href="#nav-announcement" role="tab" aria-controls="nav-announcement" aria-selected="false">Announcements</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="overview-block">
                        <h4>Recent activity</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="udemy-questions-block btm-40">
                                    <h5 class="udemy-questions-heading">Recent questions</h5>
                                    @if($coursequestions->isEmpty())
                                        <div class="udemy-questions-content text-center">
                                            <h3 class="text-center">No recent Questions</h3>
                                        </div>
                                    @else
                                        @php
                                            $questions = App\Question::where('course_id', $course->id)->orderBy('created_at','desc')->limit(2)->get();
                                        @endphp
                                        @foreach($questions as $question)
                                        <div class="udemy-questions-dtl-block">
                                            <div class="udemy-questions-img rgt-20">{{ $question->user->fname[0] }}{{ $question->user->lname[0] }}</div>
                                            <div class="udemy-questions-dtl"><a href="#" title="questions">{{ $question->question }}</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                    <div class="udemy-questions-heading"><a href="#" id="goTab3" title="browse">Browse all questions</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="udemy-questions-block btm-40">
                                    <h5 class="udemy-questions-heading">Recent instructor announcements</h5>
                                    @if($announsments->isEmpty())
                                        <div class="udemy-questions-content text-center">
                                            <h3 class="text-center">No recent announcements</h3>
                                        </div>
                                    @else
                                        <div id="accordion" class="second-accordion">
                                        @foreach($announsments->take(2) as $announsment)
                                        <div class="card">
                                            <div class="card-header" id="headingFour{{ $announsment->id }}">
                                                <div class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour{{ $announsment->id }}" aria-expanded="true" aria-controls="collapseFour">
                                                        <div class="udemy-questions-img rgt-20">{{ $announsment->user->fname[0] }}{{ $announsment->user->lname[0]  }}
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-6">
                                                                <div class="section"><a href="#" title="questions">{{ $announsment->user->fname }} {{ $announsment->user->lname }}</a> <a href="#" title="questions">{{ date('jS F Y', strtotime($announsment->created_at)) }}</a></div>
                                                            </div>
                                                            <div class="col-lg-6 col-6">
                                                                <div class="section-dividation text-right">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-8 col-6"> 
                                                                <div class="profile-heading">Announsment</div>
                                                            </div>
                                                            <div class="col-lg-4 col-6">
                                                            </div>

                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="collapseFour{{ $announsment->id }}" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                               
                                                <div class="card-body">
                                                    <p>{{ $announsment->announsment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        </div>
                                    @endif
                                    <div class="udemy-questions-heading"><a id="goTab4" href="" title="browse">Browse all announcements</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-course-block">
                            <h4 class="content-course">About this course</h4>
                            <p class="btm-40">{{ $course->short_detail }}</p>
                        </div>
                        <hr>
                        <div class="content-course-number-block">
                            <div class="row">
                                <div class="col-lg-3 col-sm-4">
                                    <div class="content-course-number">By the numbers</div>
                                </div>
                                <div class="col-lg-6 col-sm-5">
                                    <div class="content-course-number">
                                        <ul>
                                            <li>Skill level: All Level</li>
                                            <li>Students: 
                                                @php
                                                    $data = App\Order::where('course_id', $course->id)->get();
                                                    if(count($data)>0){

                                                        echo count($data);
                                                    }
                                                    else{

                                                        echo "0";
                                                    }
                                                @endphp
                                            </li>
                                            @if($course->language_id == !NULL)
                                            <li>Languages: {{ $course->language->name }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <div class="content-course-number">
                                        <ul>
                                            <li>Classes:
                                                @php
                                                    $data = App\CourseClass::where('course_id', $course->id)->get();
                                                    if(count($data)>0){

                                                        echo count($data);
                                                    }
                                                    else{

                                                        echo "0";
                                                    }
                                                @endphp
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="content-course-number">Description</div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="content-course-number content-course-one">
                                        <h5 class="content-course-number-heading">About this course</h5>
                                        <p>{{ $course->short_detail }}<p>
                                        <h5 class="content-course-number-heading">Description</h5>
                                        <p>{{ $course->detail }}<p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-3 col-sm-3">
                                    <div class="content-course-number">Instructor</div>
                                </div>
                                <div class="col-lg-9 col-sm-9">
                                    <div class="content-course-number content-course-number-one">
                                        <div class="content-img-block btm-20">
                                            <div class="content-img">
                                               

                                                @if($course->user->user_img != null || $course->user->user_img !='')
                                                  <img src="{{ asset('images/user_img/'.$course->user->user_img) }}" class="img-fluid"  alt="instructor" >
                                                @else
                                                    <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid"  alt="instructor">
                                                @endif
                                            </div>
                                            <div class="content-img-dtl">
                                                <div class="profile"><a href="#" title="profile">{{ $course->user->fname }}
                                                </a></div>
                                                <p>{{ $course->user->email }}</p>
                                            </div>
                                        </div>
                                        <ul>
                                            <li class="rgt-10"><a href="{{ $course->user['twitter_url'] }}" target="_blank" title="twitter"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="{{ $course->user['fb_url'] }}" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                        </ul>
                                        <p>{{ strip_tags($course->user->detail) }}<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="profile-block">
                        <div id="accordion" class="second-accordion">
                            <?php $i=0;?>
                            @foreach($coursechapters as $coursechapter )
                            <?php $i++;?>
                            <div class="card btm-10">
                                <div class="card-header" id="headingOne{{ $coursechapter->id }}">
                                    <div class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{ $coursechapter->id }}" aria-expanded="true" aria-controls="collapseOne">
                                            <div class="row">
                                                <div class="col-lg-6 col-6">
                                                    <div class="section">Section: <?php echo $i;?></div>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="section-dividation text-right">
                                                        @php
                                                            $classone = App\CourseClass::where('coursechapter_id', $coursechapter->id)->get();
                                                            if(count($classone)>0){

                                                                echo count($classone);
                                                            }
                                                            else{

                                                                echo "0";
                                                            }
                                                        @endphp
                                                        Classes
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile-heading">{{ $coursechapter->chapter_name }}</div>
                                        </button>
                                    </div>
                                </div>
                                <div id="collapseOne{{ $coursechapter->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">

                                    @php
                                        $classes = App\CourseClass::where('coursechapter_id', $coursechapter->id)->get();
                                    @endphp
                                    @foreach($classes as $class)
                                    <div class="card-body">
                                        <table class="table">  
                                            <tbody>
                                                <tr>
                                                    <td class="class-type">
                                                        @if($class->type =='video' && $class->video )
                                                        <a href="{{ route('watchcourseclass',$class->id) }}" title="Course" class="iframe"><i class="fa fa-play-circle"></i>&nbsp;class</a>
                                                        @endif
                                                        
                                                        @php
                                                            $url = Crypt::encrypt($class->iframe_url);
                                                        @endphp
                                                        @if($class->type =='video' && $class->iframe_url )
                                                        <a href="{{ route('watchinframe',[$url, 'course_id' => $course->id]) }}" title="Course"><i class="fa fa-play-circle"></i>&nbsp;class</a>
                                                        @endif
                                                        @if($class->type =='image' && $class->image )
                                                        <a href="{{ asset('images/class/'.$class->image) }}" download="{{$class->image}}" title="Course"><i class="fas fa-image"></i>&nbsp;save</a>
                                                        @endif
                                                        @if($class->type =='pdf' && $class->pdf )
                                                        <a href="{{route('downloadPdf',$class->id)}}" title="Course"><i class="fas fa-file-pdf"></i>&nbsp;save</a>
                                                        @endif
                                                        @if($class->type =='zip' && $class->zip )
                                                        <a href="{{ asset('files/zip/'.$class->zip) }}" download="{{$class->zip}}" title="Course"><i class="far fa-file-archive"></i>&nbsp;save</a>
                                                        @endif
                                                        @if($class->url)
                                                            @if($class->type =='video')
                                                            <a href="{{ route('watchcourseclass',$class->id) }}" title="Course" class="iframe"><i class="fa fa-play-circle"></i>&nbsp;class</a>
                                                            @endif
                                                            @if($class->type =='image')
                                                            <a href="{{ $class->url }}" title="Course"><i class="fas fa-image"></i>&nbsp;link</a>
                                                            @endif
                                                            @if($class->type =='pdf')
                                                            <a href="{{ $class->url }}" title="Course"><i class="fas fa-file-pdf"></i>&nbsp;link</a>
                                                            @endif
                                                            @if($class->type =='zip')
                                                            <a href="{{ $class->url }}" title="Course"><i class="far fa-file-archive">&nbsp;link</i></a>
                                                            @endif
                                                        @endif 
                                                    </td>

                                                    <td class="class-name">
                                                        <a href="#" title="Course">{{ $class->title }}</a>
                                                    </td>

                                                    <td class="class-size txt-rgt">
                                                        @if($class->type =='video')
                                                            {{ $class->duration }} Min
                                                        @endif
                                                        @if($class->type =='image' || $class->type =='pdf' || $class->type =='zip' )
                                                            {{ $class->size }} Mb
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="udemy-contact-block">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-search-block btm-40">
                                    <div class="udemy-contact-search">
                                        @if($coursequestions->isEmpty())
                                            <h4 class="question-text">No recent questions</h4>
                                        @else
                                            <h4 class="question-text">
                                            @php
                                                $quess = App\Question::where('course_id', $course->id)->get();
                                                if(count($quess)>0){

                                                    echo count($quess);
                                                }
                                                else{

                                                    echo "0";
                                                }
                                            @endphp
                                            questions in this course</h4>
                                        @endif
                                        
                                    </div>
                                    <div class="udemy-contact-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Ask a new question
                                        </button>

                                        <!--Model start-->
                                        <div id="myModal" class="modal fade" role="dialog">
                                          <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h4 class="modal-title">Ask a Question</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              </div>

                                              <div class="modal-body">
                                                
                                                <form id="demo-form2" method="post" action="{{ url('addquestion', $course->id) }}"
                                                    data-parsley-validate class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}
                                                            
                                                    <div class="row">
                                                      <div class="col-md-6">
                                                        <input type="hidden" name="instructor_id" class="form-control" value="{{$course->user_id}}"  />
                                                        <input type="hidden" name="user_id"  value="{{Auth::user()->id}}" />
                                                      </div>
                                                      <div class="col-md-6">
                                                        <input type="hidden" name="course_id"  value="{{$course->id}}" />
                                                        <input type="hidden" name="status"  value="1" />
                                                      </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                        <label for="detail">Question:<sup class="redstar">*</sup></label>
                                                        <textarea name="question" rows="4"  class="form-control" placeholder=""></textarea>
                                                      </div>
                                                    </div>
                                                    <br>
                                                    <div class="box-footer">
                                                     <button type="submit" class="btn btn-lg col-md-3 btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>

                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>

                                          </div>
                                        </div>
                                        <!--Model end-->
                                    </div>
                                </div>
                                
                                <div id="accordion" class="second-accordion">
                                    @php
                                        $questions = App\Question::where('course_id', $course->id)->get();
                                    @endphp
                                    @foreach($questions as $ques)
                                    @if($ques->status == 1)
                                    <div class="card btm-10">
                                        <div class="card-header" id="headingThree{{ $ques->id }}">
                                            <div class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree{{ $ques->id }}" aria-expanded="true" aria-controls="collapseThree">
                                                    <div class="udemy-questions-img rgt-20">{{ $ques->user->fname[0] }}{{ $ques->user->lname[0]  }}
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-6">
                                                            <div class="section">
                                                                <a href="#" title="questions">{{ $ques->user->fname }} </a> 
                                                                <a href="#" title="questions">{{ date('jS F Y', strtotime($ques->created_at)) }}</a>
                                                                <div class="author-tag">
                                                                    {{ $ques->user->role }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-lg-6 col-6">
                                                            <div class="section-dividation text-right">
                                                                @php
                                                                    $answer = App\Answer::where('question_id', $ques->id)->get();
                                                                    if(count($answer)>0){

                                                                        echo count($answer);
                                                                    }
                                                                    else{

                                                                        echo "0";
                                                                    }
                                                                @endphp
                                                                Response
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-8 col-6"> 
                                                            <div class="profile-heading">{{ $ques->question }}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-6"> 
                                                            <div class="profile-heading txt-rgt"><a href="#" data-toggle="modal" data-target="#myModalanswer{{ $ques->id }}" title="response">Add Answer</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                        <!--Model start-->
                                        <div class="modal fade" id="myModalanswer{{ $ques->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog modal-lg" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">

                                                  <h4 class="modal-title" id="myModalLabel">Write a Answer</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="box box-primary">
                                                  <div class="panel panel-sum">
                                                    <div class="modal-body">
                                                    
                                                    <form id="demo-form2" method="post" action="{{ url('addanswer', $ques->id) }}"
                                                        data-parsley-validate class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                        <input type="hidden" name="question_id"  value="{{$ques->id}}" />
                                                        <input type="hidden" name="instructor_id"  value="{{$course->user_id}}" />
                                                        <input type="hidden" name="ans_user_id"  value="{{Auth::user()->id}}" />
                                                        <input type="hidden" name="ques_user_id"  value="{{$ques->user_id}}" />
                                                        <input type="hidden" name="course_id"  value="{{$ques->course_id}}" />
                                                        <input type="hidden" name="question_id"  value="{{$ques->id}}" />
                                                        <input type="hidden" name="status"  value="1" />       
                                                        
                                                        <div class="row">
                                                          <div class="col-md-12">
                                                            {{ $ques->question }}
                                                            <br>
                                                            <br>
                                                          </div>
                                                          <div class="col-md-12">
                                                            <label for="detail">Answer:<sup class="redstar">*</sup></label>
                                                            <textarea name="answer" rows="4"  class="form-control" placeholder=""></textarea>
                                                          </div>
                                                        </div>
                                                        <br>
                                                        <div class="box-footer">
                                                         <button type="submit" class="btn btn-lg col-md-3 btn-primary">Submit</button>
                                                        </div>
                                                    </form>

                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div> 
                                        </div>
                                        <!--Model close -->
                                        
                                        <div id="collapseThree{{ $ques->id }}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                            @php
                                                $answers = App\Answer::where('question_id', $ques->id)->get();
                                            @endphp
                                            @foreach($answers as $ans)
                                            @if($ans->status == 1)
                                            <div class="card-body">
                                                <div class="answer-block">
                                                    <div class="row">
                                                        <div class="col-lg-1 col-2">
                                                            <div class="udemy-questions-img-two rgt-20">{{ $ans->user->fname[0] }}{{ $ans->user->lname[0]  }}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-11 col-10">
                                                            
                                                            <div class="section">
                                                                <a href="#" title="questions">{{ $ans->user->fname }}</a> <a href="#" title="questions">{{ date('jS F Y', strtotime($ans->created_at)) }}</a>
                                                                <div class="author-tag">
                                                                    {{ $ans->user->role }}
                                                                </div>
                                                            </div>
                                                            <br>

                                                            <div class="section-answer">
                                                                <a href="#" title="Course">{{ $ans->answer }}</a>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-announcement" role="tabpanel" aria-labelledby="nav-announcement-tab">
                    @if($announsments->isEmpty())
                        <div class="udemy-announcement-null text-center">
                            <div class="offset-lg-2 col-lg-8">
                                <h1>No announcements posted yet.</h1>
                                <p>The instructor hasn’t added any announcements to this course yet. Announcements are used to inform you of updates or additions to the course.</p>
                            </div>
                        </div>
                    @else
                        <div class="udemy-announcement text-center">
                            <div class="col-lg-12">
                                <div id="accordion" class="second-accordion">
                                    
                                    @foreach($announsments as $announsment)
                                    @if($announsment->status == 1)
                                    <div class="card btm-30">
                                        <div class="card-header" id="headingFive{{ $announsment->id }}">
                                            <div class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive{{ $announsment->id }}" aria-expanded="true" aria-controls="collapseFive">
                                                    <div class="udemy-questions-img rgt-20">{{ $announsment->user->fname[0] }}{{ $announsment->user->lname[0]  }}
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-6">
                                                            <div class="section"><a href="#" title="questions">{{ $announsment->user->fname }} {{ $announsment->user->lname }}</a> <a href="#" title="questions">{{ date('jS F Y', strtotime($announsment->created_at)) }}</a></div>
                                                        </div>
                                                        <div class="col-lg-6 col-6">
                                                            <div class="section-dividation text-right">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-8 col-6"> 
                                                            <div class="profile-heading">
                                                                Announsment
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-6">
                                                        </div>

                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="collapseFive{{ $announsment->id }}" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                            <div class="card-body">
                                                <p>{{ $announsment->announsment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div> 
    </div>
</section>
<!-- courses-content end -->
<!-- teach online start -->
@php
    $setting = App\Setting::first();
@endphp
@if($setting->instructor_enable == 1)
@if(Auth::User()->role == "user")
<section id="online-courses" class="online-courses-block">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-8 col-sm-12">
                <div class="online-course-img">
                    <a href="#" class="online-course"></a>
                </div>
                <div class="online-course-dtl">
                    <h5 class="online-course-heading">Teach the world online</h5>
                    <p>Create an online video course, reach students across the globe, and earn money</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="online-course-btn">
                    <a href="#" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor" class="btn btn-success">Become an instructor</a>
                </div>
            </div>
        </div>
    </div>
</section> 
@endif
@endif  
<!-- teach online end -->
@endsection

@section('custom-script')
<!-- iframe script -->
<script>
(function($) {
  "use strict";
  $(document).ready(function(){
    
    $(".group1").colorbox({rel:'group1'});
    $(".group2").colorbox({rel:'group2', transition:"fade"});
    $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
    $(".group4").colorbox({rel:'group4', slideshow:true});
    $(".ajax").colorbox();
    $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
    $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
    $(".iframe").colorbox({iframe:true, width:"100%", height:"100%"});
    $(".inline").colorbox({inline:true, width:"50%"});
    $(".callbacks").colorbox({
      onOpen:function(){ alert('onOpen: colorbox is about to open'); },
      onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
      onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
      onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
      onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
    });

    $('.non-retina').colorbox({rel:'group5', transition:'none'})
    $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
    
    
    $("#click").click(function(){ 
      $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
      return false;
    });
  });
})(jQuery);
</script>
<!-- script to remain on active tab -->
<script>
(function($) {
  "use strict";
      $(document).ready(function(){
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#nav-tab a[href="' + activeTab + '"]').tab('show');
        }
      });
})(jQuery);
</script>
<!-- link for another tab -->
<script>
(function($) {
  "use strict";
    $("#goTab4").click(function(){
        $("#nav-tab a:nth-child(4)").click();
        return false;
    });

    $("#goTab3").click(function(){
        $("#nav-tab a:nth-child(3)").click();
        return false;
    });
})(jQuery);    
</script>

@endsection
