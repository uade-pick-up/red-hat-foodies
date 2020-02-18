<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use DB;
use Auth;
use App\Cart;
use App\Wishlist;
use App\Order;
use App\Currency;
use Mail;
use App\Mail\SendOrderMail;
use App\Notifications\UserEnroll;
use App\Course;
use App\User;
use Notification;

class PayStackController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();


        $paymentdata = $paymentDetails['data'];
       

        if($paymentDetails['status'] == 'true') {

			$currency = Currency::first();

			$carts = Cart::where('user_id',Auth::User()->id)->get();

		

            $pay_amount = 0;
		   
		   	foreach($carts as $cart)
		   	{  
		   		if ($cart->offer_price != 0 || $cart->offer_price != NULL)
	            {
	                $pay_amount =  $cart->offer_price;
	            }
	            else
	            {
	                $pay_amount =  $cart->price;
	            }

	            if ($cart->disamount != 0 || $cart->disamount != NULL)
	            {
	                $cpn_discount =  $cart->disamount;
	            }
	            else
	            {
	                $cpn_discount =  '';
	            }

		        $created_order = Order::create([
		        	'course_id' => $cart->course_id,
		        	'user_id' => Auth::User()->id,
		        	'instructor_id' => $cart->courses->user_id,
		            'transaction_id' => $paymentdata['reference'],
		            'payment_method' => 'Paystack',
		            'total_amount' => $pay_amount,
		            'coupon_discount' => $cpn_discount,
		            'currency' => $paymentdata['currency'],
		            'currency_icon' => $currency->icon,
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

		\Session::flash('delete', 'Payment failed');
		    return Redirect::route('home');
    }
}
