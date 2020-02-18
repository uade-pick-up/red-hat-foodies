<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
          <img src="{{ asset('images/user_img/'.Auth::User()->user_img)}}" class="img-circle" alt="User Image">

          @else
          <img src="{{ asset('images/default/user.jpg') }}" class="img-circle" alt="User Image">

          @endif
        </div>
        <div class="pull-left info">
          <p>{{ Auth::User()->fname }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Instructor</a>
        </div>
      </div>
 

      @if(Auth::User()->role == "instructor")
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>

          <li class="{{ Nav::isRoute('instructor.index') }}"><a href="{{route('instructor.index')}}"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Dashboard</span></a></li>
          
          <li class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} {{ Nav::isResource('course') }} {{ Nav::isResource('courselang') }} treeview">
            <a href="#">
                <i class="fa fa-folder"></i>Course
                <i class="fa fa-angle-left pull-right"></i>
            </a>                            

            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('course') }}"><a href="{{url('course')}}"><i class="fa fa-book" aria-hidden="true"></i><span>Course</span></a></li>

              <li class="{{ Nav::isResource('courselang') }}"><a href="{{url('courselang')}}"> <i class="fa fa-language" aria-hidden="true"></i></i><span>Course Language</span></a></li>
            </ul>
          </li>

          <li class="{{ Nav::isResource('userenroll') }}"><a href="{{url('userenroll')}}"><i class="fa fa-user" aria-hidden="true"></i><span>User Enrolled</span></a></li>


          <li class="{{ Nav::isResource('instructorquestion') }} {{ Nav::isResource('instructoranswer') }} treeview">
            <a href="#">
                <i class="fa fa-question"></i>Question / Answer
                <i class="fa fa-angle-left pull-right"></i>
            </a>                            

            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('instructorquestion') }}"><a href="{{url('instructorquestion')}}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Question</span></a></li>

              <li class="{{ Nav::isResource('instructoranswer') }}"><a href="{{url('instructoranswer')}}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Answer</span></a></li>
            </ul>
          </li>

        <ul>
      @endif


    </section>
    <!-- /.sidebar -->
</aside>