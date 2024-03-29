<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class InitializeController extends Controller
{
    public function verify(Request $request)
    {
       
        $alldata = ['app_id' => "25613271", 'ip' => "127.0.0.1", 'domain' => \Request::getHttpHost() , 'code' => $request->code];
        $data = $this->make_request($alldata);
        if ($data['status'] == 1)
        {
            Session::put('license', 'OK');
            return redirect()->route('installApp');
        }
        elseif ($data['msg'] == 'Already Register')
        {   
            return redirect()->route('verifylicense')->withErrors(['User is already registered']);
        }
        else
        {
            
            return back()->withErrors([$data['msg']]);
        }
    }

    public function make_request($alldata)
    {
        $message = null;
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => "https://mediacity.co.in/purchase/public/api/verifycode",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_POSTFIELDS => json_encode($alldata) ,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json'

            ) ,
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        if (curl_errno($ch) > 0)
        {
            $message = "Error connecting to API.";
            return array(
                'msg' => $message,
                'status' => '0'
            );
        }
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($responseCode == 200)
        {
            $body = json_decode($response);
            if ($body->status == '1')
            {
                $file = public_path() . '\intialize.txt';
                file_put_contents($file, $body->token);
                file_put_contents(public_path() . '\code.txt', $alldata['code']);
                file_put_contents(public_path() . '\ddtl.txt', $alldata['domain']);
                return array(
                    'msg' => $body->message,
                    'status' => '1'
                );
            }
            else
            {
                $message = $body->message;
                return array(
                    'msg' => $message,
                    'status' => '0'
                );
            }
        }else
        {
            $message = "Failed to validate";
            return array(
                'msg' => $message,
                'status' => '0'
            );
        }
    }

}

