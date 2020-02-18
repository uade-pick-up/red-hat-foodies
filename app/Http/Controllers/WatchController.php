<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\CourseClass;
use App\CourseChapter;
use App\Course;
use Auth;
use Crypt;

class WatchController extends Controller
{
    public function watch($id)
    {
    	$order = Order::where('user_id', Auth::User()->id)->where('course_id', $id)->first();

        $courses = Course::where('id', $id)->first();

        if(Auth::User()->role == "admin")
        {
        	return view('watch',compact('courses'));
        }
        else
        {
            if(!empty($order))
            {
                return view('watch',compact('courses'));
            }
            else
            {
                return back()->with('delete', '401 Unauthorized Action !');
            }
        }
    }


    public function watchclass($id)
    {
        $class = CourseClass::where('id',$id)->first();
        
        if(!empty($class))
        {
            return view('classwatch',compact('order','class', 'chapter'));
        }
        else
        {
            return back()->with('delete', '401 Unauthorized Action !');
        }
    }

    public function view($url, $course_id)
    {
        $course = $course_id;
        $url = Crypt::decrypt($url);
        return view('iframe',compact('url', 'course'));
    }

   
}
