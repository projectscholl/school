<?php

namespace App\Traits;

use App\Models\Biaya;
use App\Models\Video;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

trait Ipaymu
{
    public $va;
    public $apiKey;

    public function __construct()
    {
        $this->va = config('ipaymu.va');
        $this->apiKey = config('ipaymu.api_key');
    }

    public function signature($body, $method)
    {
        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $this->va . ':' . $requestBody . ':' . $this->apiKey;
        $signature    = hash_hmac('sha256', $stringToSign, $this->apiKey);


        return $signature;
        //End Generate Signature
    }
    protected function balance()
    {
        $va           = $this->va; //get on iPaymu dashboard
        $url          = 'https://sandbox.ipaymu.com/api/v2/balance'; // for development mode
        // $url          = 'https://my.ipaymu.com/api/v2/payment'; // for production mode
        $method       = "POST"; //method
        $timestamp    = Date('YmdHis');
        $body['account']    = $va;
        $signature = $this->signature($body, $method);

        // dd($signature);

        //End Request Body//
        $headers = array(
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $signature,
            'timestamp' => $timestamp
        );

        $data_request = Http::withHeaders($headers)->post($url, [
            'account' => $va,
        ]);

        $response = $data_request->object();

        // $balance = json_decode($response);

        return $response;
    }
    public function redirect_payment($id)
    {
        $va           = $this->va; //get on iPaymu dashboard
        $url          = 'https://sandbox.ipaymu.com/api/v2/payment'; // for development mode
        // $url          = 'https://my.ipaymu.com/api/v2/payment'; // for production mode
        $method       = "POST"; //method
        $timestamp    = Date('YmdHis');

        $video = Biaya::find($id);

        $body['product'][] = $video->title;
        $body['qty'][] = 1;
        $body['price'][] = 5000;
        $body['description'][] = $video->description;
        $body['referenceId'] = 'ID' . rand(1111, 9999);
        $body['returnUrl'] = route('callback.return');
        $body['notifyUrl'] = 'https://4de0-149-108-11-161.ngrok-free.app/callback/notify';
        $body['cancelUrl'] = route('callback.cancel');
        $body['paymentMethod'] = 'qris';
        $body['buyerName'] = Auth::user()->name;


        $signature = $this->signature($body, $method);

        // dd($signature);

        //End Request Body//
        $headers = array(
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $signature,
            'timestamp' => $timestamp
        );

        $data_request = Http::withHeaders($headers)->post($url, $body);

        $response = $data_request->object();

        return $response;
    }
}
