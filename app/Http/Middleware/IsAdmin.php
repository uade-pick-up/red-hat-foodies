<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::check()) {
            
            $auth = Auth::user();

            if ($auth->role == 'admin') {  
                $dom =(file_exists(public_path().'\ddtl.txt') &&  file_get_contents(public_path().'\ddtl.txt') != null) ? file_get_contents(public_path().'\ddtl.txt') : 0;
                if( $dom != \Request::getHttpHost()){
                  $data = $this->check_status();
                  if($data != 1){
                    $path = base_path('.env');
                    if (file_exists($path)) {
                        file_put_contents($path, str_replace(
                            'IS_INSTALLED=1','IS_INSTALLED=0', file_get_contents($path)
                        ));
                    }
                    return redirect()->route('verifylicense');
                  }
                }
                return $next($request);

            } else {

                return back();

            }

        } else {

            return redirect('/');

        }

    }
    public function check_status(){
      $domain = \Request::getHttpHost();
      $token = (file_exists(public_path().'\intialize.txt') &&  file_get_contents(public_path().'\intialize.txt') != null) ? file_get_contents(public_path().'\intialize.txt') : 0;
      $code = (file_exists(public_path().'\code.txt') &&  file_get_contents(public_path().'\code.txt') != null) ? file_get_contents(public_path().'\code.txt') : 0;
          $ch = curl_init();
          $options = array(
            CURLOPT_URL => "https://mediacity.co.in/purchase/public/api/check/{$domain}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20, 
            CURLOPT_HTTPHEADER => array(
                  'Accept: application/json',
                  "Authorization: Bearer ".$token
            ),
          );
          curl_setopt_array($ch, $options);
          $response = curl_exec($ch);
        if (curl_errno($ch) > 0) { 
          $message = "Error connecting to API.";
            return 2;
        }
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($responseCode == 200) {
            $body = json_decode($response);
            return $body->status;
        }
        else{
             $message = "Failed";
            return 2;
        }
    }
}