<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PaytmWallet;
use Session;
use Redirect;
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

class PaytmController extends Controller
{
    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */

    public function register(Request $request)
    {
        $payment = $request;
        return view('paytm', compact('payment'));
    }

    public function order(Request $request)
    {

        $appurl = env('APP_URL');

        $payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => str_random(32),
          'user' => Auth::User()->id,
          'mobile_number' => Auth::User()->mobile,
          'email' => Auth::User()->email,
          'amount' => $request->amount,
          'callback_url' => $appurl."/payment/status" 
        ]);
        return $payment->receive();
    }

    /**
     * Obtain the payment information.
     *
     * @return Object
     */
    public function paymentCallback()
    {
        $transaction = PaytmWallet::with('receive');

        $response = $transaction->response();
        $order_id = $transaction->getOrderId();

        


        if($transaction->isSuccessful()){

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
                    'transaction_id' => $response['TXNID'],
                    'payment_method' => 'PayTM',
                    'total_amount' => $pay_amount,
                    'currency' => $response['CURRENCY'],
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


        }else if($transaction->isFailed()){
        
          \Session::flash('delete', 'Payment failed');
            return Redirect::route('home');
        }

    }
}
