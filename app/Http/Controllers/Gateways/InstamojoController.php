<?php

namespace App\Http\Controllers\Gateways;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class InstamojoController extends Controller
{
    public function payment(Request $request)
    {
        // validation
        $api_key = config('instamojo.api_key');
        $auth_token = config('instamojo.auth_token');

        $url = config('instamojo.endpoint') . 'payment-requests/';
        // https://test.instamojo.com/api/1.1/payment-requests/

        $response = Http::withHeaders([
            'X-Api-Key' => $api_key,
            'X-Auth-Token' => $auth_token,
        ])->post($url, [
            'purpose' => 'Online Payment',
            'amount' => $request->price,
            'buyer_name' => 'John Doe',
            'phone' => '9999999999',
            'redirect_url' => route('instamojo.callback'),
            'send_email' => true,
            'webhook' => 'http://www.example.com/handle_webhook.php',
            'send_sms' => true,
            'email' => 'test@gmail.com',
            'allow_repeated_payments' => false,
        ]);

        $responseData = json_decode($response);

        if ($responseData->success == true) {
            // success
            // redirect to payment page
            return redirect($responseData->payment_request->longurl);
        }else{
            dd($responseData->message);
        }

    }

    public function callback(Request $request){

        $api_key = config('instamojo.api_key');
        $auth_token = config('instamojo.auth_token');

        $url = config('instamojo.endpoint') . 'payments/' . $request->payment_id;
        // https://test.instamojo.com/api/1.1/payments/

        $response = Http::withHeaders([
            'X-Api-Key' => $api_key,
            'X-Auth-Token' => $auth_token,
        ])->get($url);

        if($response->failed()){
            dd($response->body());

        }else{
            $responseData = json_decode($response);

           if($responseData->success == true && $responseData->payment->status == 'Credit'){

                return 'Payment success';
            }
    }
}

}
