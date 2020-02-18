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
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      @if(Auth::User()->role == "admin")
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
        
          <li class="{{ Nav::isRoute('admin.index') }}"><a href="{{route('admin.index')}}"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Dashboard</span></a></li>

          <li class="{{ Nav::isRoute('user.index') }} {{ Nav::isRoute('user.add') }} {{ Nav::isRoute('user.edit') }}"><a href="{{route('user.index')}}"><i class="fa fa-user-o" aria-hidden="true"></i><span>User</span></a></li>

          <li class="{{ Nav::isResource('admin/country') }} {{ Nav::isResource('admin/state') }} {{ Nav::isResource('admin/city') }} treeview">
            <a href="#">
              <i class="fa fa-globe" aria-hidden="true"></i> <span>Geolocation</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('admin/country') }}"><a href="{{url('admin/country')}}"><i class="fa fa-circle-o"></i>Country</a></li>
              <li class="{{ Nav::isResource('admin/state') }}"><a href="{{url('admin/state')}}"><i class="fa fa-circle-o"></i>State</a></li>
              <li class="{{ Nav::isResource('admin/city') }}"><a href="{{url('admin/city')}}"><i class="fa fa-circle-o"></i>City</a></li>
            </ul>
          </li>

          <li class="{{ Nav::isResource('currency') }}"><a href="{{url('currency')}}"> <i class="fa fa-money"></i><span>Currency</span></a></li>

          <li class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} {{ Nav::isResource('course') }} {{ Nav::isResource('courselang') }} treeview">
            <a href="#">
                <i class="fa fa-book"></i>Course
                <i class="fa fa-angle-left pull-right"></i>
            </a>                            

            <ul class="treeview-menu">
                <li class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} treeview">
                    <a href="#"><i class="fa fa-star" aria-hidden="true"></i>Category<i class="fa fa-angle-left pull-right"></i></a>
                    
                    <ul class="treeview-menu">
                      <li class="{{ Nav::isResource('category') }}"><a href="{{url('category')}}"><i class="fa fa-circle-o"></i>Category</a></li>
                      <li class="{{ Nav::isResource('subcategory') }}"><a href="{{url('subcategory')}}"><i class="fa fa-circle-o"></i>Sub Category</a></li>
                      <li class="{{ Nav::isResource('childcategory') }}"><a href="{{url('childcategory')}}"><i class="fa fa-circle-o"></i>Child Category</a></li>
                    </ul>

                    <li class="{{ Nav::isResource('course') }}"><a href="{{url('course')}}"><i class="fa fa-book" aria-hidden="true"></i><span>Course</span></a></li>

                    <li class="{{ Nav::isResource('courselang') }}"><a href="{{url('courselang')}}"> <i class="fa fa-language" aria-hidden="true"></i></i><span>Course Language</span></a></li>

                    <li class="{{ Nav::isResource('coursereview') }}"><a href="{{url('coursereview')}}"><i class="fa fa-history" aria-hidden="true"></i><span>Course Review</span></a></li>
                </li>
            </ul>
          </li>

          <li class="{{ Nav::isResource('coupon') }}"><a href="{{url('coupon')}}"><i class="fa fa-tags" aria-hidden="true"></i><span>Coupon</span></a></li>

          <li class="{{ Nav::isRoute('all.instructor') }} {{ Nav::isResource('requestinstructor') }} treeview">
           <a href="#">
             <i class="fa fa-user-plus" aria-hidden="true"></i> <span>Instructor</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isRoute('all.instructor') }}"><a href="{{route('all.instructor')}}"><i class="fa fa-circle-o"></i>All Instructor</a></li>
              <li class="{{ Nav::isResource('requestinstructor') }}"><a href="{{url('requestinstructor')}}"><i class="fa fa-circle-o"></i>Instructor Request</a></li>
            </ul>
          </li>
          

          <li class="{{ Nav::isResource('order') }}"><a href="{{url('order')}}"><i class="fa  fa-history" aria-hidden="true"></i><span>Order</span></a></li>
    
          <li class="{{ Nav::isResource('page') }}"><a href="{{url('page')}}"><i class="fa fa-columns" aria-hidden="true"></i><span>Pages</span></a></li>

          <li class="{{ Nav::isResource('faq') }} {{ Nav::isResource('faqinstructor') }}  treeview">
           <a href="#">
             <i class="fa fa-question-circle" aria-hidden="true"></i> <span>Faq</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('faq') }}"><a href="{{url('faq')}}"><i class="fa fa-circle-o"></i>Faq Student</a></li>
              <li class="{{ Nav::isResource('faqinstructor') }}"><a href="{{url('faqinstructor')}}"><i class="fa fa-circle-o"></i>Faq Instructor</a></li>
            </ul>
          </li>
          
          <li class="{{ Nav::isResource('user/course/report') }}"><a href="{{url('user/course/report')}}"><i class="fa fa-flag" aria-hidden="true"></i><span>Report</span></a></li>

          <li class="{{ Nav::isResource('slider') }} {{ Nav::isResource('facts') }} {{ Nav::isRoute('category.slider') }} {{ Nav::isResource('coursetext') }} {{ Nav::isResource('getstarted') }} {{ Nav::isResource('trusted') }} {{ Nav::isRoute('widget.setting') }} {{ Nav::isRoute('terms') }} {{ Nav::isResource('testimonial') }} treeview">
           <a href="#">
             <i class="fa fa-sliders" aria-hidden="true"></i> <span>Front Setting</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('slider') }}"><a href="{{url('slider')}}"><i class="fa fa-circle-o"></i><span>Slider</span></a></li>
              <li class="{{ Nav::isResource('facts') }}"><a href="{{url('facts')}}"><i class="fa fa-circle-o"></i><span>Facts Slider</span></a></li>
              <li class="{{ Nav::isRoute('category.slider') }}"><a href="{{route('category.slider')}}"><i class="fa fa-circle-o"></i><span>Category Slider</span></a></li>
              <li class="{{ Nav::isResource('coursetext') }}"><a href="{{url('coursetext')}}"><i class="fa fa-circle-o"></i> Course Text</a></li>
              <li class="{{ Nav::isResource('getstarted') }}"><a href="{{url('getstarted')}}"><i class="fa fa-circle-o"></i> Get Started</a></li>
              <li class="{{ Nav::isResource('trusted') }}"><a href="{{url('trusted')}}"><i class="fa fa-circle-o"></i><span>Trusted Slider</span></a></li>
              <li class="{{ Nav::isRoute('widget.setting') }}"><a href="{{route('widget.setting')}}"><i class="fa fa-circle-o"></i>Widget Setting</a></li>
              <li class="{{ Nav::isResource('testimonial') }}"><a href="{{url('testimonial')}}"><i class="fa fa-circle-o"></i>Testimonial</a></li>
            </ul>
          </li>
          
          <li class="{{ Nav::isRoute('gen.set') }} {{ Nav::isRoute('api.setApiView') }} {{ Nav::isResource('blog') }} {{ Nav::isRoute('about.page') }} {{ Nav::isRoute('careers.page') }} {{ Nav::isRoute('comingsoon.page') }} {{ Nav::isRoute('termscondition') }} treeview">
           <a href="#">
             <i class="fa fa-cogs" aria-hidden="true"></i> <span>Site Setting</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isRoute('gen.set') }}"><a href="{{route('gen.set')}}"><i class="fa fa-circle-o"></i><span>Setting</span></a></li>
              <li class="{{ Nav::isRoute('api.setApiView') }}"><a href="{{route('api.setApiView')}}"><i class="fa fa-circle-o"></i>API Setting</a></li>
              <li class="{{ Nav::isResource('blog') }}"><a href="{{url('blog')}}"><i class="fa fa-circle-o"></i>Blog</a></li>
              <li class="{{ Nav::isRoute('about.page') }}"><a href="{{route('about.page')}}"><i class="fa fa-circle-o"></i>About</a></li>
              <li class="{{ Nav::isRoute('careers.page') }}"><a href="{{route('careers.page')}}"><i class="fa fa-circle-o"></i>Career</a></li>
              <li class="{{ Nav::isRoute('comingsoon.page') }}"><a href="{{route('comingsoon.page')}}"><i class="fa fa-circle-o"></i>Coming Soon</a></li>
              <li class="{{ Nav::isRoute('termscondition') }}"><a href="{{route('termscondition')}}"><i class="fa fa-circle-o"></i>Terms & Condition </a></li>
              <li class="{{ Nav::isRoute('policy') }}"><a href="{{route('policy')}}"><i class="fa fa-circle-o"></i> Privacy Policy</a></li>

              <li class="{{ Nav::isRoute('banktransfer') }}"><a href="{{url('banktransfer')}}"><i class="fa fa-circle-o"></i> Bank Details</a></li>
            </ul>
          </li>

          <li class="{{ Nav::isResource('languages') }}"><a href="{{url('languages')}}"><i class="fa fa-language" aria-hidden="true"></i><span>Language</span></a></li>

          <li class="{{ Nav::isResource('usermessage') }}"><a href="{{url('usermessage')}}"><i class="fa fa-phone" aria-hidden="true"></i><span>Contact Us</span></a></li>
          

        </ul>
      @endif


    </section>
    <!-- /.sidebar -->
</aside>