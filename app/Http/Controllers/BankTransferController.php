<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankTransfer;
use App\Order;
use Redirect,Response;
use App\Cart;
use Auth;
use DB;
use App\Currency;
use Session;
use App\Wishlist;
use Mail;
use App\Mail\SendOrderMail;
use App\Notifications\UserEnroll;
use App\Course;
use App\User;
use Notification;

class BankTransferController extends Controller
{
    public function banktransfer(Request $request)
    {
        // return $request;
        $currency = Currency::first();

        $carts = Cart::where('user_id',Auth::User()->id)->get();
           
        foreach($carts as $cart)
        { 
            if ($cart->offer_price != 0)
            {
                $pay_amount =  $cart->offer_price;
            }
            else
            {
                $pay_amount =  $cart->price;
            }
            
            $created_order = Order::create([
                'course_id' => $cart->course_id,
                'user_id' => Auth::User()->id,
                'instructor_id' => $cart->courses->user_id,
                'transaction_id' => str_random(32),
                'payment_method' => 'BankTransfer',
                'total_amount' => $pay_amount,
                'currency' => $currency->currency,
                'currency_icon' => $currency->icon,
                'status' => 0,
                'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                ]
            );

            Wishlist::where('user_id',Auth::User()->id)->where('course_id', $cart->course_id)->delete();

            Cart::where('user_id',Auth::User()->id)->where('course_id', $cart->course_id)->delete();

            if($created_order){
                if (env('MAIL_USERNAME')!=null) {
                    try{
                        
                        /*sending email*/
                        $x = 'You are successfully enrolled in a course';
                        $order = $created_order;
                        Mail::to(Auth::User()->email)->send(new SendOrderMail($x, $order));


                    }catch(\Swift_TransportException $e){
                        header( "refresh:5;url=./" );
                        dd("Payment Successfully ! but Invoice will not sent because admin not updated the mail setting in admin dashboard ! Redirecting you to homepage... !");
                    }
                }
            }

            if($created_order){
                // Notification when user enroll
                $cor = Course::where('id', $cart->course_id)->first();

                $course = [
                  'title' => $cor->title,
                  'image' => $cor->preview_image,
                ];

                $enroll = Order::where('course_id', $cart->course_id)->get();

                if(!$enroll->isEmpty())
                {
                    foreach($enroll as $enrol)
                    {
                        $user = User::where('id', $enrol->user_id)->get();
                        Notification::send($user,new UserEnroll($course));
                    }
                }
            }
            
        }

        \Session::flash('success', 'Payment success');
            return Redirect::route('home');
        
    }

    public function show()
    {

    	$show = BankTransfer::first();
    	return view('admin.bank_transfer.edit',compact('show'));
    }

    public function update(Request $request)
    {

    	$data = BankTransfer::first();
        $input = $request->all();

        if(isset($data))
        {
            $data->update($input);
        }
        else
        {
            $data = BankTransfer::create($input);
            $data->save();
        }

		return back()->with('success','Updated Successfully');
    }


}
