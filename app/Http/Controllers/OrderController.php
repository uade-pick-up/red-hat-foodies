<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use DB;
use App\Setting;
use App\Course;
use App\User;
use Auth;
use Redirect;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function destroy($id)
    {
        DB::table('orders')->where('id',$id)->delete();
        return back();
    }

    public function vieworder($id)
    {
        $setting = Setting::first();
        $show = Order::where('id', $id)->first();
        return view('admin.order.view', compact('show', 'setting', 'course'));
    }

    public function purchasehistory()
    {
        $course = Course::all();
        $orders = Order::all();
        if(Auth::check())
        {
            return view('front.purchase_history.purchase',compact('orders', 'course'));
        }
        return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.'); 
    }

    public function invoice($id)
    {
        $course = Course::all();
        $orders = Order::where('id', $id)->first();

        if(Auth::check())
        {
            return view('front.purchase_history.invoice',compact('orders', 'course')); 
        }

        return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.'); 
    }

    
}
